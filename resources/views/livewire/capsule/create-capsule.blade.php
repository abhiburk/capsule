<div class="py-12">
    <main class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div>
            <form wire:submit="create">
                <div class="rounded-lg bg-white shadow-md mb-8">
                    <div class="p-4 sm:p-8 space-y-6">
                        <!-- Time Capsule Name -->
                        <h2 class="text-xl font-semibold text-gray-800 text-center mb-4">
                            What would you like to name this time capsule?
                        </h2>
                        <x-text-input id="name" type="text" class="w-full" wire:model="form.name"
                            placeholder="E.g., Goals for 2030" />
                        <x-input-error class="!mt-1" :messages="$errors->get('form.name')" />

                        <!-- Public/Private Option -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Visibility {{ $form->visibility }}
                            </label>
                            <div class="flex items-center space-x-6">
                                <label class="flex items-center">
                                    <input type="radio" name="visibility" value="0" wire:model="form.visibility"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-gray-700">Private</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="visibility" value="1" wire:model="form.visibility"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-gray-700">Public</span>
                                </label>
                            </div>
                            <x-input-error class="!mt-1" :messages="$errors->get('form.visibility')" />
                        </div>
                    </div>

                    <!-- Create Button -->
                    <div class="p-4 sm:p-8 sm:pt-0">
                        <x-primary-button class="w-full justify-center flex">
                            <x-spinner wire:loading wire:target="create" />
                            {{ __('Create') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
