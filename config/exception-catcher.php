<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Exception Email Notifications
    |--------------------------------------------------------------------------
    |
    | This configuration file determines how exceptions are handled and
    | sent via email notifications to multiple recipients.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Enable Exception Catching
    |--------------------------------------------------------------------------
    |
    | Set this to true to enable automatic exception catching and email
    | notifications. Set to false to disable the package functionality.
    |
    */
    'enabled' => env('EXCEPTION_CATCHER_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Email Configuration
    |--------------------------------------------------------------------------
    |
    | Configure the email settings for exception notifications.
    |
    */
    'emails' => [
        'to' => explode(',', env('EXCEPTION_CATCHER_TO_EMAIL', 'admin@example.com')),
        'from' => env('EXCEPTION_CATCHER_FROM_EMAIL', 'noreply@example.com'),
        'from_name' => env('EXCEPTION_CATCHER_FROM_NAME', 'Exception Catcher'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    |
    | Whether to queue the email sending process to improve performance.
    | Requires a queue driver to be configured.
    |
    */
    'queue_enabled' => env('EXCEPTION_CATCHER_QUEUE_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Include Stack Trace
    |--------------------------------------------------------------------------
    |
    | Whether to include the full stack trace in the exception email.
    |
    */
    'include_stack_trace' => env('EXCEPTION_CATCHER_INCLUDE_STACK_TRACE', true),

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Configure rate limiting to prevent email spam.
    |
    */
    'rate_limiting' => [
        'enabled' => true,
        'max_emails_per_hour' => 10,
        'cache_key_prefix' => 'exception_catcher_',
    ],

    /*
    |--------------------------------------------------------------------------
    | Exception Types to Skip
    |--------------------------------------------------------------------------
    |
    | Specify which exception types should NOT be reported via email.
    |
    */
    'skip_exceptions' => [
        Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
        'Illuminate\Auth\AuthenticationException',
        'Illuminate\Validation\ValidationException',
        'Symfony\Component\HttpKernel\Exception\HttpException',
    ],

    /*
    |--------------------------------------------------------------------------
    | Include Request Data
    |--------------------------------------------------------------------------
    |
    | Whether to include request data (URL, method, parameters, etc.)
    | in the exception email.
    |
    */
    'include_request_data' => env('EXCEPTION_CATCHER_INCLUDE_REQUEST', true),
];
