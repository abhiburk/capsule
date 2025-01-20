<div class="py-12">
    <main class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div>
            <form wire:submit="create">
                <div class="rounded-lg border bg-white shadow-sm dark:bg-gray-950 dark:border-gray-800 mb-8">
                    <div class="p-4 sm:p-8 space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 text-center mb-4">
                            What would you like to name this time capsule?
                        </h2>
                        <x-text-input id="name" type="text" class="w-full" wire:model="form.name"
                            placeholder="E.g., Goals for 2030" />
                        <x-input-error class="!mt-1" :messages="$errors->get('form.name')" />
                    </div>

                    <div class="p-4 sm:p-8  sm:pt-0">
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
