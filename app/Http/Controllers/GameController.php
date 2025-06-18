<?php

namespace App\Http\Controllers;

use App\Services\FreeToGameService;

class GameController extends Controller
{
    protected $gameService;

    public function __construct(FreeToGameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function index()
    {
        $games = $this->gameService->fetchGames();

        return view('games.index', compact('games'));
    }

    public function show($id)
    {
        $apiGame = $this->gameService->fetchGameById($id);

        if (!$apiGame) {
            abort(404, 'Game not found');
        }

        $game = $this->gameService->syncGame($apiGame);

        $comments = $game->comments()->whereNull('parent_id')->with('user', 'replies.user')->get();

        return view('games.show', compact('game', 'comments'));
    }
}
