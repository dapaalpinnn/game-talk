<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Game;

class FreeToGameService
{
    protected $baseUrl = 'https://www.freetogame.com/api';

    public function fetchGames()
    {
        $response = Http::get("{$this->baseUrl}/games");

        if ($response->successful()) {
            return collect($response->json());
        }

        return collect([]);
    }

    public function fetchGameById($id)
    {
        $response = Http::get("{$this->baseUrl}/game", ['id' => $id]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    public function syncGame($apiGame)
    {
        return Game::updateOrCreate(
            ['api_id' => $apiGame['id']],
            [
                'title' => $apiGame['title'],
                'description' => $apiGame['short_description'],
                'thumbnail' => $apiGame['thumbnail'],
                'game_url' => $apiGame['game_url'],
                'genre' => $apiGame['genre'],
                'platform' => $apiGame['platform'],
                'publisher' => $apiGame['publisher'],
                'developer' => $apiGame['developer'],
                'release_date' => $apiGame['release_date'],
            ]
        );
    }
}
