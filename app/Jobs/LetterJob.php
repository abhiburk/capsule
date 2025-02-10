<?php

namespace App\Jobs;

use App\Mail\RecipientLetterEmail;
use App\Models\Letter;
use App\Notifications\LetterNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class LetterJob implements ShouldQueue
{
    use Queueable;

    public Letter $letter;
    public function __construct(string $letterId)
    {
        $this->letter = Letter::find($letterId);
    }

    public function handle(): void
    {
        if ($this->letter->user->notify(new LetterNotification($this->letter->id))) {
            $this->letter->update(['delivered_at' => now()]);
        }

        $this->letter->recipients->each(function ($recipient) {
            Mail::to($recipient->email)->send(new RecipientLetterEmail($this->letter->id));
            $recipient->update(['sent_at' => now()]);
        });
    }
}
