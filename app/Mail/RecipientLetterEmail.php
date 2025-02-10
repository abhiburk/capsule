<?php

namespace App\Mail;

use App\Models\Letter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecipientLetterEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Letter $letter;

    public function __construct(string $letterId)
    {
        $this->letter = Letter::find($letterId);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->letter->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.letter.recipient',
            with: [
                'title' => $this->letter->title,
                'message' => $this->letter->message,
                'url' => route('capsules.letters.show', $this->letter->id),
                'name' => $this->letter->user->name,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
