<?php

namespace NajibIsmail\LaravelExceptionCatcher\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
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
        $emailer = app()->make(\NajibIsmail\LaravelExceptionCatcher\ExceptionEmailer::class);
        $this->exceptionData = $emailer->getExceptionData($exception, $request);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subjectPrefix = '[' . config('app.name') . ' Exception]';
        $exceptionClass = class_basename($this->exception);
        
        $fromEmail = $this->config['emails']['from'] ?? config('mail.from.address');
        $fromName = $this->config['emails']['from_name'] ?? config('mail.from.name');
        
        return new Envelope(
            subject: $subjectPrefix . ' ' . $exceptionClass . ': ' . $this->exception->getMessage(),
            from: new Address($fromEmail, $fromName),
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
