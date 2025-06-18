<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $gameId)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $game = Game::findOrFail($gameId);

        Comment::create([
            'user_id' => Auth::id(),
            'body' => $request->body,
            'commentable_id' => $game->id,
            'commentable_type' => Game::class,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
