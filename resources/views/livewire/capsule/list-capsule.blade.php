<div class="py-12">
    <main class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="rounded-lg ">
            @if (!$capsules->isEmpty())
                <div class="p-6 flex justify-between item-center">
                    <div>
                        <h2 class="text-lg font-semibold">Your Capsules</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Shareable capsules</p>
                    </div>
                    <div>
                        <x-primary-link href="{{ route('capsules.create') }}" wire:navigate>
                            Create
                        </x-primary-link>
                    </div>
                </div>
            @endif
            <div class="p-6 space-y-4">
                @forelse ($capsules as $capsule)
                    <div class="rounded-lg border bg-white p-6 shadow flex items-start space-x-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold">
                                <a href="{{ route('capsules.show', $capsule->slug) }}"
                                    class="hover:text-blue-500">{{ $capsule->name }}</a>
                            </h3>
                            <p class="text-sm text-gray-700 mb-4">
                                {{ $capsule->description }}
                            </p>
                            <div class="text-xs text-gray-500 flex justify-between">
                                <p>Created on {{ $capsule->created_at->toFormattedDateString() }}</p>
                                <a href="{{ route('capsules.messages.index', $capsule->id) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ $capsule->messages_count }}
                                    {{ Str::plural('message', $capsule->messages_count) }}
                                </a>
                            </div>
                        </div>
                    </div>


                @empty
                    <div class="flex flex-col items-center justify-center py-12 space-y-4">
                        <svg class="w-20 h-20 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6M9 8h6m5 9H6a2 2 0 00-2 2v2h18v-2a2 2 0 00-2-2z" />
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-700">Oops! Nothing Here</h3>
                        <p class="text-gray-500">Write message to yourself through capsules</p>
                        <x-primary-link href="{{ route('capsules.create') }}" wire:navigate>
                            Create Capsule
                        </x-primary-link>
                    </div>
                @endforelse
                {{ $capsules->links(data: ['scrollTo' => false]) }}
            </div>
        </div>
    </main>
</div>
