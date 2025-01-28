<div class="py-12">
    <main class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="rounded-lg ">
            @if (!$letters->isEmpty())
                <div class="p-6 flex justify-between item-center">
                    <div>
                        <h2 class="text-lg font-semibold">Your Scheduled Messages</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Messages waiting to be delivered</p>
                    </div>
                    <div>
                        <x-primary-link href="{{ route('capsules.show', $capsule->id) }}" wire:navigate>
                            Send Message
                        </x-primary-link>
                    </div>
                </div>
            @endif
            <div class="p-6 space-y-4">
                @forelse ($letters as $letter)
                    @if ($letter->scheduled_at->isPast())
                        <div class="rounded-lg border bg-white p-6 shadow">
                            <h3 class="text-xl font-bold mb-2 text-green-600">Delivered</h3>
                            <p class="text-sm text-gray-500">
                                {{ $letter->message }}
                            </p>
                            <div class="mt-4 text-xs text-gray-400 flex justify-between items-center">
                                <p>Created on {{ $letter->created_at->toFormattedDateString() }}</p>
                                @foreach ($letter->channels as $channel)
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-600">
                                        {{ $channel }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="rounded-lg border bg-white p-4 flex justify-between items-center shadow">
                            <div class="space-y-1">
                                <h3 class="font-medium text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 17l4 4m0 0l4-4m-4 4V3">
                                        </path>
                                    </svg>
                                    Scheduled at {{ $letter->scheduled_at->toFormattedDateString() }}
                                </h3>

                                <p class="text-sm text-gray-500">Delivery in
                                    {{ $letter->scheduled_at->diffForHumans() }}</p>
                                <p class="text-xs text-gray-400">Created on
                                    {{ $letter->created_at->toFormattedDateString() }}</p>
                            </div>
                            @foreach ($letter->channels as $channel)
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-600">
                                    {{ $channel }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                @empty
                    <div class="flex flex-col items-center justify-center space-y-4 py-12">
                        <svg class="w-16 h-16 text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6M9 8h2m4-4H7a2 2 0 00-2 2v16l4-4h8a2 2 0 002-2V6a2 2 0 00-2-2z" />
                        </svg>
                        <div class="text-center flex flex-col items-center space-y-2">
                            <h3
                                class="dark:text-gray-100 font-poppins whitespace-normal sm:text-h2 text-xl font-semibold">
                                No letters found.
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 ">Write a letter to your future self
                            </p>
                        </div>
                        <x-primary-link href="{{ route('capsules.show', $capsule->id) }}" wire:navigate>
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Send Message
                        </x-primary-link>
                    </div>
                @endforelse
                {{ $letters->links(data: ['scrollTo' => false]) }}
            </div>
        </div>
    </main>
</div>
