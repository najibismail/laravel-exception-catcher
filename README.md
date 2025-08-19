# Laravel Exception Catcher

[![Latest Version on Packagist](https://img.shields.io/packagist/v/najibismail/laravel-exception-catcher.svg?style=flat-square)](https://packagist.org/packages/najibismail/laravel-exception-catcher)
[![Total Downloads](https://img.shields.io/packagist/dt/najibismail/laravel-exception-catcher.svg?style=flat-square)](https://packagist.org/packages/najibismail/laravel-exception-catcher)
[![License](https://img.shields.io/packagist/l/najibismail/laravel-exception-catcher.svg?style=flat-square)](https://packagist.org/packages/najibismail/laravel-exception-catcher)
[![PHP Version](https://img.shields.io/packagist/php-v/najibismail/laravel-exception-catcher.svg?style=flat-square)](https://packagist.org/packages/najibismail/laravel-exception-catcher)

A powerful Laravel package that automatically catches exceptions and sends beautifully formatted, responsive email notifications to multiple recipients.

## 🚀 Features

- 🚨 **Automatic Exception Catching** - Seamlessly integrates with Laravel's exception handler
- 📧 **Multiple Recipients** - Send alerts to multiple email addresses
- 📱 **Responsive Email Design** - Beautiful emails that work on all devices and email clients
- ⚡ **Rate Limiting** - Prevents email spam with intelligent throttling
- 🔧 **Configurable Filtering** - Choose which exception types to report/skip
- 📊 **Rich Information** - Includes request data, stack trace, user info, and environment details
- ⚙️ **Queue Support** - Async email sending for better performance
- 🧪 **Built-in Testing** - Command line and web testing tools included
- 🎨 **Stack Trace Enhancement** - Color-coded, row-by-row stack traces with source type indicators

## 📦 Installation

```bash
composer require najibismail/laravel-exception-catcher
```

The service provider will be automatically registered (Laravel 5.5+).

## ⚡ Quick Start

1. **Publish configuration**:
   ```bash
   php artisan vendor:publish --provider="NajibIsmail\LaravelExceptionCatcher\ExceptionCatcherServiceProvider" --tag="config"
   ```

2. **Configure emails in `.env`**:
   ```env
   EXCEPTION_CATCHER_TO_EMAIL="admin@yourapp.com"
   EXCEPTION_CATCHER_FROM_EMAIL="noreply@yourapp.com"
   ```

3. **Add to your Exception Handler** (`app/Exceptions/Handler.php`):
   ```php
   use NajibIsmail\LaravelExceptionCatcher\Traits\SendsExceptionEmails;
   
   class Handler extends ExceptionHandler
   {
       use SendsExceptionEmails;
       
       public function report(Throwable $exception)
       {
           $this->sendExceptionEmail($exception, request());
           parent::report($exception);
       }
   }
   ```

4. **Test it**:
   ```bash
   php artisan exception:test
   ```

## ⚙️ Configuration

Edit `config/exception-catcher.php` to customize behavior:

```php
return [
    'enabled' => env('EXCEPTION_CATCHER_ENABLED', true),
    
    'emails' => [
        'to' => explode(',', env('EXCEPTION_CATCHER_TO_EMAIL', 'admin@example.com')),
        'from' => env('EXCEPTION_CATCHER_FROM_EMAIL', 'noreply@example.com'),
        'from_name' => env('EXCEPTION_CATCHER_FROM_NAME', 'Exception Catcher'),
    ],
    
    'queue_enabled' => env('EXCEPTION_CATCHER_QUEUE_ENABLED', false),
    'include_stack_trace' => env('EXCEPTION_CATCHER_INCLUDE_STACK_TRACE', true),
    
    'rate_limiting' => [
        'enabled' => true,
        'max_emails_per_hour' => 10,
        'cache_key_prefix' => 'exception_catcher_',
    ],
    
    'skip_exceptions' => [
        Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
    ],
];
```

### Environment Variables

Add these to your `.env` file:

```env
# Exception Catcher Configuration
EXCEPTION_CATCHER_ENABLED=true
EXCEPTION_CATCHER_TO_EMAIL="admin@yourapp.com,dev@yourapp.com"
EXCEPTION_CATCHER_FROM_EMAIL="noreply@yourapp.com"
EXCEPTION_CATCHER_FROM_NAME="Your App Name"
EXCEPTION_CATCHER_QUEUE_ENABLED=false
EXCEPTION_CATCHER_INCLUDE_STACK_TRACE=true

# Laravel Mail Configuration  
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

## 🔧 Manual Usage

You can also send exception emails manually in your code:

```php
use NajibIsmail\LaravelExceptionCatcher\Facades\ExceptionCatcher;

try {
    // Your code here
} catch (Exception $e) {
    ExceptionCatcher::handle($e, request());
    throw $e; // Re-throw if needed
}
```

## 🧪 Testing

### Command Line Testing
```bash
php artisan exception:test [type]
```

**Available Types:** `runtime`, `invalid`, `custom`, `db`, `fatal`, `validation`, `http`

### Web Route Testing
```
GET http://your-app.com/exception-test
GET http://your-app.com/exception-test/runtime
```

**Results:** Exception caught → Email sent → Beautiful responsive template

## 📧 Email Features

- **Responsive Design** - Adapts to desktop, tablet, and mobile
- **Email Client Support** - Gmail, Outlook, Apple Mail, Thunderbird  
- **Enhanced Stack Traces** - Color-coded with source indicators (ORIGIN, APP, VENDOR)
- **Rich Information** - Request data, user details, environment info

## 🔍 Troubleshooting

### Not Receiving Emails?
1. Check your Laravel mail configuration
2. Verify recipient email addresses in config
3. Check spam/junk folders
4. Test Laravel mail with `php artisan tinker`:
   ```php
   Mail::raw('Test', function($msg) {
       $msg->to('your-email@example.com')->subject('Test');
   });
   ```

### Command Not Found?
- Run `composer dump-autoload`
- Verify package installation: `composer show najibismail/laravel-exception-catcher`

### Web Routes Not Working?
- Clear route cache: `php artisan route:clear`
- Check if service provider is registered: `php artisan route:list | grep exception-test`

### Rate Limiting Issues?
- Check cache configuration
- Clear cache: `php artisan cache:clear`
- Adjust rate limits in config file

## 🏗️ Package Structure

```
packages/laravel-exception-catcher/
├── .gitignore                          # Git ignore rules
├── LICENSE                             # MIT License  
├── README.md                           # This documentation
├── composer.json                       # Package configuration
├── config/
│   └── exception-catcher.php          # Configuration file
├── resources/
│   └── views/
│       └── exception-email.blade.php  # Responsive email template
├── routes/
│   └── web.php                        # Test routes
└── src/
    ├── Console/Commands/
    │   └── TestExceptionCatcher.php    # Test command
    ├── ExceptionCatcherServiceProvider.php # Service provider
    ├── ExceptionEmailer.php            # Core logic
    ├── Facades/
    │   └── ExceptionCatcher.php        # Facade
    ├── Mail/
    │   └── ExceptionNotification.php   # Mailable class
    └── Traits/
        └── SendsExceptionEmails.php    # Handler trait
```

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## � Support

- **Issues**: [GitHub Issues](https://github.com/najibismail/laravel-exception-catcher/issues)
- **Email**: najibismail1986@gmail.com
- **Discussions**: [GitHub Discussions](https://github.com/najibismail/laravel-exception-catcher/discussions)

## �📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## 🏷️ Version

**Current Version**: 1.0.0  
**Laravel Compatibility**: 8.x, 9.x, 10.x, 11.x  
**PHP Compatibility**: 8.0+

---

Made with ❤️ for the Laravel community

```php
return [
    // Enable/disable the package
    'enabled' => env('EXCEPTION_CATCHER_ENABLED', true),
    
    // Email recipients
    'recipients' => [
        'developer@example.com',
        'admin@example.com',
    ],
    
    // Email subject prefix
    'subject_prefix' => env('EXCEPTION_CATCHER_SUBJECT_PREFIX', '[' . env('APP_NAME', 'Laravel') . ' Exception]'),
    
    // Rate limiting (in minutes)
    'rate_limit_minutes' => env('EXCEPTION_CATCHER_RATE_LIMIT', 30),
    
    // Exception types to skip
    'skip_exceptions' => [
        'Illuminate\Auth\AuthenticationException',
        'Illuminate\Validation\ValidationException',
        'Symfony\Component\HttpKernel\Exception\HttpException',
        'Symfony\Component\HttpKernel\Exception\NotFoundHttpException',
    ],
    
    // Include request data and stack trace
    'include_request_data' => env('EXCEPTION_CATCHER_INCLUDE_REQUEST', true),
    'include_stack_trace' => env('EXCEPTION_CATCHER_INCLUDE_STACK_TRACE', true),
    
    // Queue email sending
    'queue_emails' => env('EXCEPTION_CATCHER_QUEUE_EMAILS', false),
];
```

## Environment Variables

Add these variables to your `.env` file:

```env
EXCEPTION_CATCHER_ENABLED=true
EXCEPTION_CATCHER_SUBJECT_PREFIX="[MyApp Exception]"
EXCEPTION_CATCHER_RATE_LIMIT=30
EXCEPTION_CATCHER_INCLUDE_REQUEST=true
EXCEPTION_CATCHER_INCLUDE_STACK_TRACE=true
EXCEPTION_CATCHER_QUEUE_EMAILS=false
```

## Usage

### Method 1: Using the Trait (Recommended)

Modify your `app/Exceptions/Handler.php` to use the trait:

```php
<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Local\LaravelCatchException\Traits\SendsExceptionEmails;
use Throwable;

class Handler extends ExceptionHandler
{
    use SendsExceptionEmails;

    // Your existing exception handler code...
}
```

### Method 2: Manual Integration

If you prefer manual control, you can manually call the exception emailer:

```php
<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function report(Throwable $exception)
    {
        parent::report($exception);

        // Send exception email
        if (app()->bound('exception.emailer')) {
            app('exception.emailer')->handle($exception, request());
        }
    }
}
```

### Method 3: Using the Facade

You can also use the facade to manually send exception emails:

```php
use Local\LaravelCatchException\Facades\ExceptionCatcher;

// In your code
try {
    // Some risky operation
} catch (Exception $e) {
    ExceptionCatcher::handle($e, request());
    throw $e; // Re-throw if needed
}
```

## Email Template

The package includes a beautiful HTML email template that shows:

- Exception class and message
- File and line number where the exception occurred
- Timestamp and environment information
- Request details (URL, method, IP, user agent)
- User information (if authenticated)
- Request parameters and headers
- Full stack trace (if enabled)

## Rate Limiting

To prevent email spam, the package includes rate limiting. The same exception (based on class, message, file, and line) will only be sent once within the configured time period (default: 30 minutes).

## Queue Support

For better performance, you can enable email queueing by setting `queue_emails` to `true` in the configuration. Make sure you have a queue worker running:

```bash
php artisan queue:work
```

## Filtering Exceptions

### Skip Specific Exceptions

Add exception classes to the `skip_exceptions` array to prevent them from being emailed:

```php
'skip_exceptions' => [
    'Illuminate\Auth\AuthenticationException',
    'Illuminate\Validation\ValidationException',
    'App\Exceptions\IgnoredException',
],
```

### Report Only Specific Exceptions

Use the `reportable_exceptions` array to only send emails for specific exception types:

```php
'reportable_exceptions' => [
    'RuntimeException',
    'App\Exceptions\CriticalException',
],
```

## Customizing the Email Template

After publishing the views, you can customize the email template by editing:
`resources/views/vendor/exception-catcher/exception-email.blade.php`

## Security

The package automatically filters sensitive information from request data:
- Passwords and tokens are replaced with `[FILTERED]`
- Sensitive headers (Authorization, Cookie) are excluded
- User information is limited to ID and email only

## Testing

You can test the package by triggering an exception in your application:

```php
// Add this to a route for testing
Route::get('/test-exception', function () {
    throw new \Exception('This is a test exception');
});
```

## Requirements

- PHP 8.0 or higher
- Laravel 8.0 or higher
- Mail configuration in your Laravel application

## License

This package is open-sourced software licensed under the MIT license.
