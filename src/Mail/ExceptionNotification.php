<?php

namespace NajibIsmail\LaravelExceptionCatcher\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use Throwable;

class ExceptionNotification extends Mailable
{
    use SerializesModels;

    /**
     * The exception instance.
     */
    public Throwable $exception;

    /**
     * The request instance.
     */
    public ?Request $request;

    /**
     * Configuration array.
     */
    public array $config;

    /**
     * Exception data.
     */
    public array $exceptionData;

    /**
     * Create a new message instance.
     */
    public function __construct(Throwable $exception, ?Request $request = null, array $config = [])
    {
        $this->exception = $exception;
        $this->request = $request;
        $this->config = $config;
        
        // Use ExceptionEmailer for consistent data formatting
        $emailer = app()->make(\NajibIsmail\LaravelCatchException\ExceptionEmailer::class);
        $this->exceptionData = $emailer->getExceptionData($exception, $request);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subjectPrefix = $this->config['subject_prefix'] ?? '[Exception]';
        $exceptionClass = class_basename($this->exception);
        
        return new Envelope(
            subject: $subjectPrefix . ' ' . $exceptionClass . ': ' . $this->exception->getMessage(),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'laravel-exception-catcher::exception-email',
            with: [
                'exceptionData' => $this->exceptionData,
                'config' => $this->config,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
