<x-app-layout>
    <section class="max-w-6xl mx-auto bg-black text-white py-20">
        <div class="container mx-auto px-4 text-center space-y-5 pt-10">
            @guest
            <h1 class="text-3xl md:text-7xl mb-4 font-michroma tracking-tight mt-8 leading-snug md:leading-relaxed">
                Welcome to <span class="bg-white text-black px-2">Game Talk</span>
            </h1>
            <p class="text-lg md:text-xl mb-6">a space where players from all backgrounds come together to share stories, exchange tips, discuss game mechanics, and discover new titles. Whether you're into casual mobile games or competitive multiplayer experiences, this is the place to connect and grow with fellow gamers.</p>
            @endguest

            @auth
            <h1 class="text-3xl md:text-6xl mb-8 font-michroma tracking-tight">Lets Explore, <span class="bg-white text-black px-2">{{ Auth::user()->name }}!</span></h1>
            <p class="text-lg md:text-xl mb-6">a space where players from all backgrounds come together to share stories, exchange tips, discuss game mechanics, and discover new titles. Whether you're into casual mobile games or competitive multiplayer experiences, this is the place to connect and grow with fellow gamers.</p>
            @endauth

            @guest
            <div class="flex justify-center text-sm space-x-4">
                <a href="{{ route('register') }}" class="bg-transparent border border-gray-500 text-white font-semibold px-6 py-3 rounded-full transition">Daftar</a>
                <a href="{{ route('login') }}" class="bg-white text-black font-semibold px-6 py-3 rounded-full transition">Masuk</a>
            </div>
            @endguest

        </div>
    </section>

    <section class="py-20 text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold mb-10 text-center text-white font-michroma">Featured Games</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($games as $game)
                <div class="rounded-2xl shadow overflow-hidden">
                    <div class="rounded-lg shadow overflow-hidden rounded-t-lg">
                        <div class="relative h-96">
                            <img src="{{ $game['thumbnail'] }}" alt="{{ $game['title'] }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 flex items-end">
                                <div class="w-full p-4 bg-gradient-to-t from-black/100 via-black/75 to-transparent backdrop-blur-xl rounded-t-3xl">
                                    <h2 class="text-white text-lg font-bold">{{ Str::limit($game['title'], 20) }}</h2>
                                    <p class="text-white text-sm mt-1">{{ Str::limit($game['short_description'], 70) }}</p>
                                    <a href="{{ route('games.show', $game['id']) }}"
                                        class="mt-3 inline-block text-white w-full rounded-full text-sm px-4 py-2 bg-transparent border border-gray-400">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('games.index') }}" class="text-blue-500 font-semibold hover:underline">See All Games</a>
            </div>
        </div>
    </section>

    <section class="pb-12">
        <div class="max-w-5xl container mx-auto px-4 pb-20 mt-10 text-center space-y-4">
            <h1 class="text-4xl font-bold mb-8 text-center text-white font-michroma">About</h1>
            <p class="text-white text-xl">This platform was created to bring together game enthusiasts from all walks of life. Here, you can share your gaming experiences, recommend your favorite titles, ask questions, and dive into meaningful conversations about the world of games—from the latest releases and timeless classics to underrated indie gems.</p>
        </div>
    </section>

    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4 text-center font-michroma">Join Our Community</h2>
            <p class="text-lg text-gray-600 mb-6">Connect with gamers, share your thoughts, and discuss strategies!</p>
            @auth
            <a href="{{ route('games.index') }}" class="bg-black text-white font-semibold px-6 py-3 rounded-full hover:gray-900 transition">Start Discussing</a>
            @else
            <a href="{{ route('register') }}" class="bg-black text-white font-semibold px-6 py-3 rounded-full hover:gray-900 transition">Join Now</a>
            @endauth
        </div>
    </section>
</x-app-layout>