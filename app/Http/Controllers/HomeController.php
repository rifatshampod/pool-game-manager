<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all games with their winners
        $tournaments = Game::with('winner')->get();

        // Pass the data to the view
        return view('welcome', compact('tournaments'));
    }
}