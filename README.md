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
- ⚡ **Rate Limiting** - Prevents email spam with intelligent throttling (enabled by default)
- 🔧 **Configurable Filtering** - Choose which exception types to report/skip with blacklist and whitelist support
- 📊 **Rich Information** - Includes request data, stack trace, user info, and environment details
- ⚙️ **Queue Support** - Async email sending for better performance
- 🧪 **Built-in Testing** - Command line and web testing tools included
- 🎨 **Stack Trace Enhancement** - Color-coded, row-by-row stack traces with source type indicators
- ✅ **Enable/Disable Control** - Easy toggle for exception catching functionality

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
       
       // The trait automatically handles exception reporting
       // No need to override the report() method
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
        'enabled' => env('EXCEPTION_CATCHER_RATE_LIMITING_ENABLED', true),
        'max_emails_per_hour' => env('EXCEPTION_CATCHER_MAX_EMAILS_PER_HOUR', 10),
        'cache_key_prefix' => 'exception_catcher_',
    ],
    
    'skip_exceptions' => [
        Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
        'Illuminate\Auth\AuthenticationException',
        'Illuminate\Validation\ValidationException',
        'Symfony\Component\HttpKernel\Exception\HttpException',
    ],
    
    'reportable_exceptions' => [
        // Example: 'App\Exceptions\CustomException',
        // Leave empty to report all exceptions (except skipped ones)
    ],
    
    'include_request_data' => env('EXCEPTION_CATCHER_INCLUDE_REQUEST', true),
];
```

### Configuration Options Explained

#### Exception Filtering

**Skip Exceptions (Blacklist)**
```php
'skip_exceptions' => [
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
    'Illuminate\Auth\AuthenticationException',
    'Illuminate\Validation\ValidationException',
],
```
These exception types will **NOT** be reported via email.

**Reportable Exceptions (Whitelist)**
```php
'reportable_exceptions' => [
    'App\Exceptions\CustomException',
    'Symfony\Component\Debug\Exception\FatalErrorException',
],
```
If this array is **not empty**, only these exception types will be reported. If **empty**, all exceptions (except skipped ones) will be reported.

#### Rate Limiting
```php
'rate_limiting' => [
    'enabled' => true,              // Enable/disable rate limiting
    'max_emails_per_hour' => 10,    // Maximum emails per hour
    'cache_key_prefix' => 'exception_catcher_',  // Cache key prefix
],
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
EXCEPTION_CATCHER_INCLUDE_REQUEST=true

# Rate Limiting Configuration
EXCEPTION_CATCHER_RATE_LIMITING_ENABLED=true
EXCEPTION_CATCHER_MAX_EMAILS_PER_HOUR=10

# Laravel Mail Configuration  
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

## 🔧 Integration Methods

### Method 1: Using the Trait (Recommended)

The trait automatically handles exception reporting. Simply add it to your Exception Handler:

```php
<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use NajibIsmail\LaravelExceptionCatcher\Traits\SendsExceptionEmails;
use Throwable;

class Handler extends ExceptionHandler
{
    use SendsExceptionEmails;
    
    // The trait automatically overrides the report() method
    // No additional code needed
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

You can also send exception emails manually anywhere in your code:

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
- **Automatic From Address** - Uses configuration or Laravel's default mail settings
- **Queue Support** - Optional async email sending for better performance

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
- Check cache configuration in `config/cache.php`
- Clear cache: `php artisan cache:clear`
- Adjust rate limits in your `.env` file:
  ```env
  EXCEPTION_CATCHER_RATE_LIMITING_ENABLED=true
  EXCEPTION_CATCHER_MAX_EMAILS_PER_HOUR=20  # Increase if needed
  ```
- Or disable rate limiting temporarily:
  ```env
  EXCEPTION_CATCHER_RATE_LIMITING_ENABLED=false
  ```

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

**Current Version**: 1.0.8  
**Laravel Compatibility**: 8.x, 9.x, 10.x, 11.x  
**PHP Compatibility**: 8.0+

---

Made with ❤️ for the Laravel community

