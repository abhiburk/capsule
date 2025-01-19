<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Message;

new class extends Component {
    use WithPagination;

    public function with(): array
    {
        return [
            'messages' => Message::simplePaginate(3),
        ];
    }
}; ?>

<div class="rounded-lg ">
    <div class="p-6">
        <h2 class="text-lg font-semibold">Your Scheduled Messages</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Messages waiting to be delivered</p>
    </div>

    <div class="p-6 space-y-4">
        @foreach ($messages as $message)
            <div class="rounded-lg border p-4 dark:border-gray-800 bg-white">
                <div class="flex justify-between items-start mb-2">
                    <div class="space-y-1">
                        <h3 class="font-medium">Delivery at {{ $message->scheduled_at->toFormattedDateString() }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Delivery in {{ $message->scheduled_at->diffForHumans() }}
                        </p>
                    </div>
                    @foreach ($message->channels as $channel)
                        <span
                            class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-100">
                            {{ $channel }}
                        </span>
                    @endforeach
                </div>
                @if ($message->is_public && $message->scheduled_at->isPast())
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $message->content }}
                    </p>
                @endif
            </div>
        @endforeach
        {{ $messages->links(data: ['scrollTo' => false]) }}
    </div>
</div>
