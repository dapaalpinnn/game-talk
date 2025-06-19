<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FreeToGameService;
use Illuminate\Pagination\LengthAwarePaginator;

class GameController extends Controller
{
    protected $gameService;

    public function __construct(FreeToGameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function welcome()
    {
        $games = $this->gameService->fetchGames()->take(8);

        return view('welcome', compact('games'));
    }

    public function index(Request $request)
    {


        $allGames = collect($this->gameService->fetchGames());

        $search = $request->query('search');

        if ($search) {
            $allGames = $allGames->filter(fn($game) => stripos(
                $game['title'],
                $search
            ) !== false ||
                stripos(
                    $game['short_description'],
                    $search
                ) !== false);
        }

        $perPage = 20;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $allGames->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $games = new LengthAwarePaginator(
            $currentPageItems,
            $allGames->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

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
