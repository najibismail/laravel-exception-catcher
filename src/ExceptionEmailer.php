<?php

namespace NajibIsmail\LaravelExceptionCatcher;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Throwable;
use NajibIsmail\LaravelExceptionCatcher\Mail\ExceptionNotification;

class ExceptionEmailer
{
    /**
     * Configuration array.
     */
    protected array $config;

    /**
     * Create a new ExceptionEmailer instance.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Handle the exception and send email if necessary.
     */
    public function handle(Throwable $exception, ?Request $request = null): void
    {
        if (!$this->shouldReport($exception)) {
            return;
        }

        if ($this->isRateLimited($exception)) {
            return;
        }

        $this->sendExceptionEmail($exception, $request);
        $this->updateRateLimit($exception);
    }

    /**
     * Determine if the exception should be reported.
     */
    protected function shouldReport(Throwable $exception): bool
    {
        $exceptionClass = get_class($exception);

        // Check if this exception type should be skipped
        if (in_array($exceptionClass, $this->config['skip_exceptions'] ?? [])) {
            return false;
        }

        // Check if only specific exceptions should be reported
        $reportableExceptions = $this->config['reportable_exceptions'] ?? [];
        if (!empty($reportableExceptions) && !in_array($exceptionClass, $reportableExceptions)) {
            return false;
        }

        return true;
    }

    /**
     * Check if the exception is rate limited.
     */
    protected function isRateLimited(Throwable $exception): bool
    {
        $rateLimitMinutes = $this->config['rate_limit_minutes'] ?? 0;
        
        if ($rateLimitMinutes <= 0) {
            return false;
        }

        $cacheKey = $this->getRateLimitCacheKey($exception);
        
        return Cache::has($cacheKey);
    }

    /**
     * Update the rate limit for this exception.
     */
    protected function updateRateLimit(Throwable $exception): void
    {
        $rateLimitMinutes = $this->config['rate_limit_minutes'] ?? 0;
        
        if ($rateLimitMinutes <= 0) {
            return;
        }

        $cacheKey = $this->getRateLimitCacheKey($exception);
        Cache::put($cacheKey, true, now()->addMinutes($rateLimitMinutes));
    }

    /**
     * Get the cache key for rate limiting.
     */
    protected function getRateLimitCacheKey(Throwable $exception): string
    {
        return 'exception_emailer:' . md5(get_class($exception) . $exception->getMessage() . $exception->getFile() . $exception->getLine());
    }

    /**
     * Send the exception email.
     */
    protected function sendExceptionEmail(Throwable $exception, ?Request $request = null): void
    {
        try {
            $recipients = $this->config['recipients'] ?? [];
            
            if (empty($recipients)) {
                Log::warning('Exception Catcher: No recipients configured for exception emails');
                return;
            }

            $mailable = new ExceptionNotification($exception, $request, $this->config);

            if ($this->config['queue_emails'] ?? false) {
                Mail::to($recipients)
                    ->queue($mailable);
            } else {
                Mail::to($recipients)
                    ->send($mailable);
            }

        } catch (Throwable $emailException) {
            Log::error('Exception Catcher: Failed to send exception email', [
                'original_exception' => [
                    'class' => get_class($exception),
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                ],
                'email_exception' => [
                    'class' => get_class($emailException),
                    'message' => $emailException->getMessage(),
                    'file' => $emailException->getFile(),
                    'line' => $emailException->getLine(),
                ],
            ]);
        }
    }

    /**
     * Get exception data for email.
     */
    public function getExceptionData(Throwable $exception, ?Request $request = null): array
    {
        $data = [
            'exception_class' => get_class($exception),
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'environment' => app()->environment(),
            'app_name' => config('app.name', 'Laravel'),
        ];

        if ($this->config['include_stack_trace'] ?? true) {
            $data['stack_trace'] = $exception->getTraceAsString();
            $data['stack_trace_array'] = $this->parseStackTrace($exception);
        }

        if ($request && ($this->config['include_request_data'] ?? true)) {
            $data['request'] = [
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'headers' => $this->filterSensitiveHeaders($request->headers->all()),
                'parameters' => $this->filterSensitiveData($request->all()),
            ];

            if ($request->user()) {
                $data['user'] = [
                    'id' => $request->user()->id ?? null,
                    'email' => $request->user()->email ?? null,
                ];
            }
        }

        return $data;
    }

    /**
     * Filter sensitive headers.
     */
    protected function filterSensitiveHeaders(array $headers): array
    {
        $sensitiveHeaders = ['authorization', 'cookie', 'set-cookie'];
        
        return array_filter($headers, function ($key) use ($sensitiveHeaders) {
            return !in_array(strtolower($key), $sensitiveHeaders);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Filter sensitive data from request parameters.
     */
    protected function filterSensitiveData(array $data): array
    {
        $sensitiveFields = ['password', 'password_confirmation', 'token', 'api_token', 'current_password'];
        
        foreach ($sensitiveFields as $field) {
            if (isset($data[$field])) {
                $data[$field] = '[FILTERED]';
            }
        }

        return $data;
    }

    /**
     * Parse stack trace into individual entries for better display.
     */
    protected function parseStackTrace(Throwable $exception): array
    {
        $trace = $exception->getTrace();
        $parsedTrace = [];
        
        // Add the exception origin as the first entry
        $parsedTrace[] = [
            'index' => 0,
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'function' => 'Exception thrown',
            'class' => get_class($exception),
            'type' => '::',
            'args' => [],
            'is_vendor' => $this->isVendorFile($exception->getFile()),
            'short_file' => $this->getShortFilePath($exception->getFile()),
        ];

        // Parse each stack trace entry
        foreach ($trace as $index => $entry) {
            $file = $entry['file'] ?? 'unknown';
            $line = $entry['line'] ?? 0;
            $function = $entry['function'] ?? 'unknown';
            $class = $entry['class'] ?? '';
            $type = $entry['type'] ?? '';
            $args = $entry['args'] ?? [];

            $parsedTrace[] = [
                'index' => $index + 1,
                'file' => $file,
                'line' => $line,
                'function' => $function,
                'class' => $class,
                'type' => $type,
                'args' => $this->formatArgs($args),
                'is_vendor' => $this->isVendorFile($file),
                'short_file' => $this->getShortFilePath($file),
                'full_call' => $this->formatMethodCall($class, $type, $function),
            ];
        }

        return $parsedTrace;
    }

    /**
     * Check if a file is in the vendor directory.
     */
    protected function isVendorFile(string $file): bool
    {
        return strpos($file, '/vendor/') !== false || strpos($file, '\\vendor\\') !== false;
    }

    /**
     * Get shortened file path for better display.
     */
    protected function getShortFilePath(string $file): string
    {
        $basePath = base_path();
        if (strpos($file, $basePath) === 0) {
            return str_replace($basePath . DIRECTORY_SEPARATOR, '', $file);
        }
        
        return basename(dirname($file)) . '/' . basename($file);
    }

    /**
     * Format method call for display.
     */
    protected function formatMethodCall(string $class, string $type, string $function): string
    {
        if (!empty($class)) {
            return $class . $type . $function . '()';
        }
        
        return $function . '()';
    }

    /**
     * Format function arguments for display.
     */
    protected function formatArgs(array $args): string
    {
        if (empty($args)) {
            return '';
        }

        $formattedArgs = [];
        foreach ($args as $arg) {
            if (is_object($arg)) {
                $formattedArgs[] = get_class($arg);
            } elseif (is_array($arg)) {
                $formattedArgs[] = 'Array(' . count($arg) . ')';
            } elseif (is_string($arg)) {
                $formattedArgs[] = '"' . (strlen($arg) > 50 ? substr($arg, 0, 50) . '...' : $arg) . '"';
            } elseif (is_null($arg)) {
                $formattedArgs[] = 'null';
            } elseif (is_bool($arg)) {
                $formattedArgs[] = $arg ? 'true' : 'false';
            } else {
                $formattedArgs[] = (string) $arg;
            }
        }

        return implode(', ', array_slice($formattedArgs, 0, 3)) . (count($formattedArgs) > 3 ? ', ...' : '');
    }
}
