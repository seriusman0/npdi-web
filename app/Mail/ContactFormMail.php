<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactMessage $contactMessage) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesan Baru: ' . $this->contactMessage->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.contact-form',
            with: ['contactMessage' => $this->contactMessage],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
