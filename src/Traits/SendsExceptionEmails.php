<?php

namespace NajibIsmail\LaravelExceptionCatcher\Traits;

use Throwable;
use Illuminate\Http\Request;
use NajibIsmail\LaravelExceptionCatcher\ExceptionEmailer;

trait SendsExceptionEmails
{
    /**
     * Send exception email notification.
     */
    protected function sendExceptionEmail(Throwable $exception, ?Request $request = null): void
    {
        if (app()->bound('exception.emailer')) {
            app('exception.emailer')->handle($exception, $request);
        }
    }

    /**
     * Report or log an exception with email notification.
     */
    public function report(Throwable $exception): void
    {
        parent::report($exception);

        // Send email notification
        $request = app('request');
        $this->sendExceptionEmail($exception, $request);
    }
}
