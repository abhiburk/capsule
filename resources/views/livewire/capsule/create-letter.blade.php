<div class="py-12">
    <main class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div>
            <form wire:submit="store">
                <div class="rounded-lg border bg-white shadow-sm dark:bg-gray-950 dark:border-gray-800 mb-8">
                    <div class="p-4 sm:p-8 ">
                        <h2 class="text-3xl font-semibold pb-2">{{ $capsule->name }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Write a letter to your future self</p>
                    </div>

                    <div class="p-4 sm:p-8 space-y-6 sm:pt-0">
                        <!-- Delivery Options -->
                        <div class="space-y-3">
                            <label class="text-sm font-medium">When should your future self receive this?</label>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($this->periods as $period => $label)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="scheduled_days" wire:model="form.scheduled_days"
                                            value="{{ $period }}" class="hidden peer">
                                        <div
                                            class="px-4 py-2 text-sm border rounded-md text-center hover:bg-gray-50 transition-colors dark:border-gray-800 dark:hover:bg-gray-800 peer-checked:bg-gray-800 peer-checked:text-white">
                                            {{ $label }}
                                        </div>
                                    </label>
                                @endforeach

                                <!-- Custom Date (Disabled) -->
                                <label class="cursor-not-allowed">
                                    <input type="radio" name="scheduled_days" value="custom" class="hidden" disabled>
                                    <div
                                        class="px-4 py-2 text-sm border rounded-md text-center bg-gray-100 text-gray-500 border-gray-300 dark:bg-gray-800 dark:text-gray-600">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Custom Date (Coming Soon)
                                    </div>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('form.scheduled_days')" class="mt-2" />
                        </div>

                        <!-- Message Input -->
                        <div class="space-y-3">
                            <label class="text-sm font-medium">Your Message</label>
                            <textarea wire:model="form.message"
                                class="{{ $errors->get('form.message') ? 'border-red-500' : '' }} w-full min-h-[150px] rounded-md border resize-none border-gray-200 focus:border-gray-400 focus:ring-2 focus:ring-gray-300 focus:outline-none p-3 text-sm dark:border-gray-800 dark:bg-gray-950 dark:focus:border-gray-700 dark:focus:ring-gray-700"
                                placeholder="Dear future me..."></textarea>
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>Take your time, this letter will wait</span>
                                {{-- <span>0/1000 characters</span> --}}
                            </div>
                            {{-- <x-input-error :messages="$errors->get('form.content')" class="mt-2" /> --}}
                        </div>

                        <!-- Attachments -->
                        <div class="space-y-3">
                            <label class="text-sm font-medium">Add attachments (optional)</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Add Photos Button (Disabled) -->
                                <button disabled
                                    class="h-24 border rounded-md bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-600 border-gray-300 flex flex-col items-center justify-center gap-2 cursor-not-allowed">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm">Add Photos (Coming Soon)</span>
                                </button>
                                <!-- Add Video Button (Disabled) -->
                                <button disabled
                                    class="h-24 border rounded-md bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-600 border-gray-300 flex flex-col items-center justify-center gap-2 cursor-not-allowed">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm">Add Video (Coming Soon)</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 sm:p-8  sm:pt-0">
                        <x-primary-button class="w-full justify-center flex">
                            <x-spinner wire:loading wire:target="store" />
                            {{ __('Schedule Message') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
