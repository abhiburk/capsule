<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <main class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div>
                <!-- Greeting -->
                <div class="text-left flex justify-between items-center">
                    <div>
                        <h2 class="font-bold text-lg md:text-3xl text-gray-800">Hi 👋 {{ auth()->user()->name }}</h2>
                        <p class="text-gray-600 mt-2 text-xs md:text-lg">
                            Welcome back to your {{ config('app.name') }} dashboard!
                        </p>
                    </div>

                    <div class="flex space-x-4">
                        <x-primary-link
                            href="{{ route('capsules.letters.create', auth()->user()->default_capsule()->slug) }}"
                            wire:navigate>
                            Write a Letter
                        </x-primary-link>

                        <x-primary-link href="{{ route('capsules.create') }}" wire:navigate>
                            Create Capsule
                        </x-primary-link>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
                    <!-- Total Capsules -->
                    <a href="{{ route('capsules.index') }}" wire:navigate
                        class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">{{ $myCapsules }}</h3>
                            <p class="text-gray-500 text-sm">Total Capsules</p>
                        </div>
                        <svg class="w-8 h-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16l4-4-4-4m8 8l-4-4 4-4" />
                        </svg>
                    </a>

                    <!-- Total Messages -->
                    <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">{{ $myLetters }}</h3>
                            <p class="text-gray-500 text-sm">Total Messages</p>
                        </div>
                        <svg class="w-8 h-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 10l-7 7-7-7" />
                        </svg>
                    </div>

                    <!-- Other Stats (Optional) -->
                    <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">{{ 98 }}</h3>
                            <p class="text-gray-500 text-sm">Other Stat</p>
                        </div>
                        <svg class="w-8 h-8 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </div>
                </div>
            </div>
            <hr>
            <!-- Capsules Section -->
            <div>
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold text-2xl text-gray-700">Explore Public Capsules</h3>
                    <a href="{{ route('capsules.index') }}" wire:navigate class="text-blue-500 hover:underline">
                        View All
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                    @foreach ($publicCapsules as $capsule)
                        <div class="bg-white shadow-md rounded-lg p-4 flex flex-col">
                            <div class="flex flex-col space-y-4">
                                <h4 class="font-semibold text-lg text-gray-700">{{ $capsule->title }}</h4>
                                <p class="text-gray-500 text-sm line-clamp-3">{{ $capsule->description }}</p>
                            </div>
                            <div class="mt-auto">
                                <div class="flex justify-between items-center mt-4">
                                    <p class="text-sm text-gray-500">
                                        Messages: <span
                                            class="font-semibold text-gray-800">{{ $capsule->letters_count }}</span>
                                    </p>
                                    <a href="{{ route('capsules.show', $capsule->slug) }}" wire:navigate
                                        class="text-blue-500 hover:underline text-sm">
                                        Write Message
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
