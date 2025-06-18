<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <img src="{{ $game->thumbnail }}" alt="{{ $game->title }}" class="w-full h-64 object-cover rounded">
                <h1 class="text-3xl font-bold mt-4">{{ $game->title }}</h1>
                <p class="text-gray-600 mt-2">{{ $game->description }}</p>
                <p class="mt-2"><strong>Genre:</strong> {{ $game->genre }}</p>
                <p><strong>Platform:</strong> {{ $game->platform }}</p>
                <p><strong>Publisher:</strong> {{ $game->publisher }}</p>
                <p><strong>Developer:</strong> {{ $game->developer }}</p>
                <p><strong>Release Date:</strong> {{ $game->release_date }}</p>
                <a href="{{ $game->game_url }}" target="_blank" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Play Now</a>
            </div>

            <!-- Komentar -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold mb-4">Comments</h2>

                @auth
                <form action="{{ route('comments.store', $game->id) }}" method="POST" class="mb-6">
                    @csrf
                    <textarea name="body" rows="4" class="w-full border rounded p-2" placeholder="Add a comment..."></textarea>
                    <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
                </form>
                @else
                <p class="mb-4">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> to add a comment.</p>
                @endauth

                <!-- Daftar Komentar -->
                @foreach ($comments as $comment)
                <div class="border-b py-4">
                    <p class="font-semibold">{{ $comment->user->name }}</p>
                    <p class="text-gray-600">{{ $comment->body }}</p>
                    <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    @auth
                    <button onclick="toggleReplyForm('{{ $comment->id }}')" class="text-blue-500 text-sm">Reply</button>
                    <form id="reply-form-{{ $comment->id }}" action="{{ route('comments.store', $game->id) }}" method="POST" class="hidden mt-2">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <textarea name="body" rows="3" class="w-full border rounded p-2" placeholder="Add a reply..."></textarea>
                        <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit Reply</button>
                    </form>
                    @endauth

                    <!-- Balasan Komentar -->
                    @foreach ($comment->replies as $reply)
                    <div class="ml-6 mt-2 border-l pl-4">
                        <p class="font-semibold">{{ $reply->user->name }}</p>
                        <p class="text-gray-600">{{ $reply->body }}</p>
                        <p class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>

            <script>
                function toggleReplyForm(commentId) {
                    const form = document.getElementById(`reply-form-${commentId}`);
                    form.classList.toggle('hidden');
                }
            </script>
        </div>
    </div>
</x-app-layout>