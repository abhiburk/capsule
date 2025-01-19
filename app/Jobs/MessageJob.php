<?php

namespace App\Jobs;

use App\Models\Message;
use App\Notifications\MessageNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MessageJob implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $messages = Message::where('scheduled_at', '<=', now())
            ->whereNull('delivered_at')
            ->get();

        $messages->each(function (Message $message): void {
            if ($message->user->notify(new MessageNotification($message))) {
                $message->update(['delivered_at' => now()]);
            }
        });
    }
}
