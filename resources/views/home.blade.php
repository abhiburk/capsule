<x-app-layout>
    <div class="py-12">
        <main class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2 class="font-semibold text-3xl text-gray-700">Hi 👋 {{ auth()->user()->name }}</h2>
            <p class="text-muted">
                Welcome to your {{ config('app.name') }} dashboard. You're logged in!
            </p>
            <a href="{{ route('capsules.create') }}" class="text-blue-500 hover:underline">Create your first capsule</a> |
            <a href="{{ route('capsules.index') }}" class="text-blue-500 hover:underline">View Capsules</a>
        </main>
    </div>
</x-app-layout>
