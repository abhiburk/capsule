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
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold">
                                    <a href="{{ route('capsules.show', $capsule->slug) }}"
                                        class="hover:text-blue-500">{{ $capsule->name }}</a>
                                </h3>
                                <a href="#">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                            <p class="text-sm text-gray-700 mb-4">
                                {{ $capsule->description }}
                            </p>
                            <div class="text-xs text-gray-500 flex items-center space-x-2">
                                <p>Created on {{ $capsule->created_at->toFormattedDateString() }}</p>
                                <span class="text-xs">&bull;</span>
                                <p>{{ $capsule->visibility_name }}</p>
                                <span class="text-xs">&bull;</span>
                                <a href="{{ route('capsules.letters.index', $capsule->id) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ $capsule->letters_count }}
                                    {{ Str::plural('letter', $capsule->letters_count) }}
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
                        <p class="text-gray-500">Write letter to yourself through capsules</p>
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
