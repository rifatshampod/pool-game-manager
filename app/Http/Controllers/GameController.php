<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Score;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'gameDate' => 'required|date',
            'players' => 'required|array',
            'players.*' => 'required|string',
        ]);

        // Create a new game
        $game = new Game();
        $game->game_date = $validatedData['gameDate'];
        $game->save();

        // Save each player with the game ID
        foreach ($validatedData['players'] as $player) {
            $score = new Score();
            $score->game_id = $game->id;
            $score->player = $player;
            $score->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Game created successfully!');
    }
}