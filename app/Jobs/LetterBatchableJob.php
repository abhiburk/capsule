<?php

namespace App\Jobs;

use App\Models\Letter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Bus;

class LetterBatchableJob implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $letters = Letter::where('scheduled_at', '<=', now())->whereNull('delivered_at');
        $letters->chunk(100, function ($letters) {
            $jobs = $letters->map(function ($letter) {
                return new LetterJob($letter->id);
            });

            Bus::batch($jobs)->name('Letter Delivery')->onQueue('high')->dispatch();
        });
    }
}
