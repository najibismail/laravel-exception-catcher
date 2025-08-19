<?php

namespace NajibIsmail\LaravelExceptionCatcher\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void handle(\Throwable $exception, ?\Illuminate\Http\Request $request = null)
 * @method static array getExceptionData(\Throwable $exception, ?\Illuminate\Http\Request $request = null)
 *
 * @see \NajibIsmail\LaravelCatchException\ExceptionEmailer
 */
class ExceptionCatcher extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'exception.emailer';
    }
}
