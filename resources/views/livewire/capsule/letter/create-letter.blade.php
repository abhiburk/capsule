<div class="py-12 px-4 sm:px-6 lg:px-8">
    <main class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <div>
            <form wire:submit="store">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column: Message Input -->
                    <div
                        class="lg:col-span-2 rounded-lg border bg-white shadow-sm dark:bg-gray-950 dark:border-gray-800 p-6">
                        <h2 class="text-3xl font-semibold pb-2">A letter from {{ now()->format('M d, Y') }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $capsule->title }}</p>

                        <div class="space-y-6 mt-6">
                            <div class="space-y-3">
                                <label class="text-sm font-medium">When should your future self receive this?</label>
                                <div class="flex flex-wrap gap-3">

                                    <!-- Custom Date -->
                                    @if ($form->scheduled_type === 'custom')
                                        <input type="date" wire:model="form.scheduled_days"
                                            min="{{ now()->addDays(7)->format('Y-m-d') }}"
                                            class="px-4 py-2 text-sm border rounded-md text-center hover:bg-gray-50 transition-colors dark:border-gray-800 dark:hover:bg-gray-800 peer-checked:bg-gray-800 peer-checked:text-white"
                                            placeholder="Select a date" />

                                        <label class="cursor-pointer">
                                            <input type="radio" name="scheduled_type"
                                                wire:model.live="form.scheduled_type" value="days"
                                                class="hidden peer">
                                            <div
                                                class="px-4 py-2 text-sm border rounded-md text-center hover:bg-gray-50 transition-colors dark:border-gray-800 dark:hover:bg-gray-800 peer-checked:bg-gray-800 peer-checked:text-white">
                                                Choose Duration
                                            </div>
                                        </label>
                                    @else
                                        @foreach ($this->periods as $period => $label)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="scheduled_days"
                                                    wire:model="form.scheduled_days" value="{{ $period }}"
                                                    class="hidden peer">
                                                <div
                                                    class="px-4 py-2 text-sm border rounded-md text-center hover:bg-gray-50 transition-colors dark:border-gray-800 dark:hover:bg-gray-800 peer-checked:bg-gray-800 peer-checked:text-white">
                                                    {{ $label }}
                                                </div>
                                            </label>
                                        @endforeach
                                        <label class="cursor-pointer">
                                            <input type="radio" name="scheduled_type"
                                                wire:model.live="form.scheduled_type" value="custom"
                                                class="hidden peer">
                                            <div
                                                class="px-4 py-2 text-sm border rounded-md text-center hover:bg-gray-50 transition-colors dark:border-gray-800 dark:hover:bg-gray-800 peer-checked:bg-gray-800 peer-checked:text-white">
                                                Custom Date
                                            </div>
                                        </label>
                                    @endif
                                </div>
                                <x-input-error :messages="$errors->get('form.scheduled_days')" class="mt-2" />
                            </div>

                            <div class="space-y-3">
                                <label class="text-sm font-medium">Your Message</label>
                                <textarea wire:model.live="form.message"
                                    class="w-full min-h-[150px] rounded-md border resize-none border-gray-200 focus:border-gray-400 focus:ring-2 focus:ring-gray-300 focus:outline-none p-3 text-sm dark:border-gray-800 dark:bg-gray-950 dark:focus:border-gray-700 dark:focus:ring-gray-700"
                                    placeholder="Dear future me..."></textarea>
                                <div class="flex justify-between text-sm text-gray-500">
                                    <span>Take your time, this letter will wait</span>
                                    <span>{{ strlen($form->message) }} characters</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <label class="text-sm font-medium">Add attachments (optional)</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <button disabled
                                        class="h-24 border rounded-md bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-600 border-gray-300 flex flex-col items-center justify-center gap-2 cursor-not-allowed">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-sm">Add Photos (Coming Soon)</span>
                                    </button>
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
                    </div>

                    <!-- Right Column: Audience & Recipients -->
                    <div class="rounded-lg border bg-white shadow-sm dark:bg-gray-950 dark:border-gray-800 p-6">
                        <div class="space-y-6">
                            <div class="space-y-3">
                                <label class="text-sm font-medium">Your Audience</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="is_public" wire:model="form.is_public"
                                            value="0" class="hidden peer">
                                        <div
                                            class="px-4 py-2 text-sm border rounded-md text-center hover:bg-gray-50 transition-colors dark:border-gray-800 dark:hover:bg-gray-800 peer-checked:bg-gray-800 peer-checked:text-white">
                                            Private
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="is_public" wire:model="form.is_public"
                                            value="1" class="hidden peer">
                                        <div
                                            class="px-4 py-2 text-sm border rounded-md text-center hover:bg-gray-50 transition-colors dark:border-gray-800 dark:hover:bg-gray-800 peer-checked:bg-gray-800 peer-checked:text-white">
                                            Public, but anonymous
                                        </div>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('form.is_public')" class="mt-2" />
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label for="request-location"
                                        class="inline-flex items-center {{ $form->location ? 'cursor-not-allowed' : '' }}"
                                        id="location-label">
                                        <input wire:model.live="form.location" id="request-location" type="checkbox"
                                            name="location" {{ $form->location ? 'disabled' : '' }}
                                            class="{{ $form->location ? 'cursor-not-allowed' : '' }} rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" />
                                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                            {{ __('Allow access to my current location') }}
                                            <x-spinner wire:loading wire:target="form.location" />
                                        </span>
                                    </label>
                                    <p class="text-xs text-gray-400">
                                        By allowing access to your location, we can use the your current location to
                                        show where the letter was written.
                                    </p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <label class="text-sm font-medium">Add Recipients</label>
                                <div class="flex gap-2">
                                    <div class="relative flex-1">
                                        <x-text-input type="email" value="{{ auth()->user()->email }}" readonly
                                            disabled
                                            class="block w-full rounded-lg border px-4 py-2.5 sm:text-sm pr-10 bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-600 border-gray-300 flex-col items-center justify-center gap-2 cursor-not-allowed" />
                                    </div>
                                </div>
                                @foreach ($form->recipients as $key => $recipient)
                                    <div class="flex gap-2">
                                        <div class="relative flex-1">
                                            <x-text-input type="email" placeholder="Friend or family email"
                                                wire:model="form.recipients.{{ $key }}"
                                                class="block w-full rounded-lg border px-4 py-2.5 sm:text-sm pr-10" />
                                        </div>
                                        <button wire:click.prevent="removeRecipient({{ $key }})"
                                            class="p-2.5 rounded-lg border border-gray-200 text-gray-500 hover:text-red-600 hover:border-red-200 hover:bg-red-50 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                                <button wire:click.prevent="addRecipient"
                                    class="mt-3 inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add another recipient
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <x-primary-button class="w-full md:w-auto flex justify-center">
                        <x-spinner wire:loading wire:target="store" />
                        {{ __('Schedule') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </main>
</div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        if (navigator.permissions) {
            navigator.permissions.query({
                name: 'geolocation'
            }).then(permissionStatus => {
                console.log(permissionStatus.state);
                if (permissionStatus.state === 'granted') {
                    getLocation();
                } else {
                    document.getElementById("request-location").addEventListener("click", getLocation);
                }
            });
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    console.log(position.coords.latitude, position.coords.longitude);
                    Livewire.dispatch('location-granted', {
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude
                    });
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    });
</script>
