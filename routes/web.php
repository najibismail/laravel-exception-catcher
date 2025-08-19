<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Laravel Exception Catcher Test Routes
|--------------------------------------------------------------------------
|
| These routes are used for testing the Laravel Exception Catcher package.
| They throw various types of exceptions to test the email notification
| functionality across different scenarios.
|
*/

// Test route for various exception types
Route::get('/exception-test/{type?}', function ($type = 'runtime') {
    $testTypes = [
        'runtime', 'invalid', 'custom', 'db', 'fatal', 'validation', 'http'
    ];

    // If no type specified or invalid type, return simple instruction
    if (!in_array($type, $testTypes)) {
        return response()->json([
            'message' => 'Laravel Exception Catcher - Test Routes',
            'available_types' => $testTypes,
            'usage' => [
                'web' => 'Visit /exception-test/{type} to test exceptions via web',
                'command' => 'Run "php artisan exception:test {type}" to test via command line'
            ],
            'examples' => [
                'http://your-app.com/exception-test/runtime',
                'http://your-app.com/exception-test/db', 
                'http://your-app.com/exception-test/validation'
            ]
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // Throw the appropriate exception based on type
    switch ($type) {
        case 'runtime':
            throw new \RuntimeException('This is a test RuntimeException from web route for Exception Catcher package');

        case 'invalid':
            throw new \InvalidArgumentException('This is a test InvalidArgumentException from web route for Exception Catcher package');

        case 'custom':
            throw new \Exception('This is a custom test exception from web route for Exception Catcher package');

        case 'db':
            throw new \PDOException('Database connection failed (test exception from web route for Exception Catcher package)');

        case 'fatal':
            throw new \Error('This is a test fatal error from web route for Exception Catcher package');

        case 'validation':
            throw new \Illuminate\Validation\ValidationException(
                validator([], ['test_field' => 'required|email'])
            );

        case 'http':
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Page not found (test exception from web route)');

        default:
            throw new \Exception('Unknown exception type: ' . $type);
    }
})->name('exception.test.web');

// Alternative route name for backward compatibility  
Route::get('/test-exception-web/{type?}', function ($type = 'runtime') {
    return redirect()->route('exception.test.web', ['type' => $type]);
})->name('test.exception.web');
