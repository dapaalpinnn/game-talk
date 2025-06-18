<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-6">Game Forum</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($games as $game)
                <div class="bg-white rounded-lg shadow p-4">
                    <img src="{{ $game['thumbnail'] }}" alt="{{ $game['title'] }}" class="w-full h-48 object-cover rounded">
                    <h2 class="text-xl font-semibold mt-4">{{ $game['title'] }}</h2>
                    <p class="text-gray-600">{{ Str::limit($game['short_description'], 100) }}</p>
                    <a href="{{ route('games.show', $game['id']) }}" class="mt-4 inline-block text-blue-500 hover:underline">View Details</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>