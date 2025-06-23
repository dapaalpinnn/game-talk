<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-lg shadow p-6 mb-6 flex gap-x-4">
                <img src="{{ $game->thumbnail }}" alt="{{ $game->title }}" class="w-1/2 h-96 object-cover rounded-3xl">
                <div class="text-gray-200 px-6 flex flex-col justify-center">
                    <h1 class="text-4xl font-bold mt-2 font-michroma">{{ $game->title }}</h1>
                    <p class="text-gray-300 mt-4">{{ $game->description }}</p>
                    <div class="space-y-2 mt-6">
                        <p><strong>Genre:</strong> {{ $game->genre }}</p>
                        <p><strong>Platform:</strong> {{ $game->platform }}</p>
                        <p><strong>Publisher:</strong> {{ $game->publisher }}</p>
                        <p><strong>Developer:</strong> {{ $game->developer }}</p>
                        <p><strong>Release Date:</strong> {{ $game->release_date }}</p>
                    </div>
                    <a href="{{ $game->game_url }}" target="_blank" class="mt-6 w-fit inline-block bg-white text-black px-4 py-2 rounded-full hover:bg-gray-300 font-semibold text-sm">Play Now</a>
                </div>
            </div>

            <div class="rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold mb-4 text-white font-michroma">Chats</h2>
                @auth
                <form action="{{ route('comments.store', $game->id) }}" method="POST" class="mb-6">
                    @csrf
                    @method('POST')
                    <input type="text" name="body" rows="4" class="w-full border rounded p-2 bg-transparent text-gray-200 font-semibold" placeholder="Add a comment..."></input>
                    <button type="submit" class="mt-4 bg-white text-gray-800 px-4 py-1.5 rounded-xl">Send</button>
                </form>
                @else
                <p class="mb-4 text-gray-300">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> to add a comment.</p>
                @endauth

                @foreach ($comments as $comment)
                <div class="border-b py-4 text-gray-400">
                    <p class="font-semibold text-sm">{{ $comment->user->name }}</p>
                    <p class="text-gray-200">{{ $comment->body }} - <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span></p>
                    <div class="flex space-x-2 mt-1">
                        @auth
                        <button onclick="toggleReplyForm('{{ $comment->id }}')" class="text-blue-500 text-sm hover:underline">Reply</button>
                        @if (Auth::id() === $comment->user_id)
                        <form action="{{ route('comments.destroy', [$game->id, $comment->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-sm hover:underline">Delete</button>
                        </form>
                        @endif
                        @endauth
                    </div>

                    @auth
                    <form id="reply-form-{{ $comment->id }}" action="{{ route('comments.store', $game->id) }}" method="POST" class="hidden mt-2">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <textarea name="body" rows="3" class="w-full border rounded p-2 bg-transparent text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Add a reply..."></textarea>
                        @error('body')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit Reply</button>
                    </form>
                    @endauth

                    @foreach ($comment->replies as $reply)
                    <div class="ml-6 mt-2 border-l pl-4 border-gray-400">
                        <p class="font-semibold text-sm">{{ $reply->user->name }}</p>
                        <p class="text-gray-200">{{ $reply->body }} - <span class="text-gray-500 text-sm">{{ $reply->created_at->diffForHumans() }}</span></p>
                        @auth
                        @if (Auth::id() === $reply->user_id)
                        <form action="{{ route('comments.destroy', [$game->id, $reply->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reply?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-sm hover:underline">Delete</button>
                        </form>
                        @endif
                        @endauth
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