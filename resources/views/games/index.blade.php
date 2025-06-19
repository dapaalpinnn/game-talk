<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight tracking-normal font-michroma">
            {{ __('Games') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center space-y-4">
            <h2 class="font-semibold text-4xl text-gray-200 leading-tight tracking-normal font-michroma">Browse and discuss your favorite games!</h2>
            <p class="text-gray-400 mt-2 text-lg">Click on a game to view its discussion thread, share your thoughts, or start a new conversation with fellow gamers.</p>
            <form action="{{ route('games.index') }}" method="GET" class="mb-8 max-w-md mx-auto" id="search-form">
                <div class="flex">
                    <input type="text"
                        name="search"
                        placeholder="Search games..."
                        class="w-full px-4 py-2 rounded-l-full text-gray-400 font-semibold focus:outline-none bg-transparent"
                        id="search-input"
                        value="{{ request('search') }}">
                    <button type="submit"
                        id="search-button"
                        class="bg-white text-black px-6 py-2 rounded-r-full font-semibold hover:bg-gray-200 transition">Search</button>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 pt-12">
                @foreach ($games as $game)
                <div class="rounded-2xl shadow overflow-hidden">
                    <div class="rounded-lg shadow overflow-hidden rounded-t-lg">
                        <div class="relative h-96">
                            <img src="{{ $game['thumbnail'] }}" alt="{{ $game['title'] }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 flex items-end">
                                <div class="w-full p-4 bg-gradient-to-t from-black via-black/80 to-transparent backdrop-blur-xl  rounded-t-3xl">
                                    <h2 class="text-white text-lg font-bold">{{ Str::limit($game['title'], 20) }}</h2>
                                    <p class="text-white text-sm mt-1">{{ Str::limit($game['short_description'], 70) }}</p>
                                    <a href="{{ route('games.show', $game['id']) }}"
                                        class="mt-3 w-full inline-block text-white rounded-full text-sm px-4 py-2 bg-transparent border border-gray-400">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $games->links() }}
            </div>
        </div>
    </div>
    <script>
        const searchForm = document.getElementById('search-form');
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-button');

        function toogleSearchButton() {
            searchButton.disabled = searchInput.value.trim().length === 0;
        }

        toogleSearchButton();
        searchInput.addEventListener('input', toogleSearchButton);

        searchForm.addEventListener('submit', (event) => {
            if (searchInput.value.trim().length === 0) {
                event.preventDefault();
            }
        });
    </script>
</x-app-layout>