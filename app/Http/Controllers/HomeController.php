<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all games with their winners
        $tournaments = Game::with('winner')->get();
        
        // Calculate leaderboard data
        $leaderboard = DB::table('scores')
            ->join('players', 'scores.player_id', '=', 'players.id')
            ->select('players.id', 'players.name', DB::raw('SUM(scores.score) as total_points'))
            ->groupBy('players.id', 'players.name')
            ->orderByDesc('total_points')
            ->get();

        // Pass the data to the view
        return view('welcome', compact('tournaments', 'leaderboard'));
    }

    public function storePlayer(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Save the player to the database
        Player::create([
            'name' => $request->input('name'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Player added successfully!');
    }
}