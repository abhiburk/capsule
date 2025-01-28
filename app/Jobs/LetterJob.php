<?php

namespace App\Jobs;

use App\Models\Letter;
use App\Notifications\LetterNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class LetterJob implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $letters = Letter::where('scheduled_at', '<=', now())
            ->whereNull('delivered_at')
            ->get();

        $letters->each(function (Letter $letter): void {
            if ($letter->user->notify(new LetterNotification($letter))) {
                $letter->update(['delivered_at' => now()]);
            }
        });
    }
}
