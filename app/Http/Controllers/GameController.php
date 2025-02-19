<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Group;
use App\Models\GroupPlayer;
use App\Models\MatchGame;
use App\Models\Player;
use App\Models\Round;
use App\Models\Score;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function create()
    {
        $playerList = Player::all();
        return view('game/addGame')->with('playerList', $playerList);
    }
    //save and start tournament
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'gameDate' => 'required|date',
            'boardNumber' => 'required|integer|min:1',
            'players' => 'required|array|min:2', // At least 2 players are required
        ]);

        // Step 1: Save the game data
        $game = Game::create([
            'date' => $request->input('gameDate'),
            'total_players' => count($request->input('players')),
            'total_boards' => $request->input('boardNumber'),
        ]);

        // Step 2: Create groups
        $boardNumber = $request->input('boardNumber');
        $groups = [];

        for ($i = 0; $i < $boardNumber; $i++) {
            $groupName = chr(65 + $i); // A, B, C, etc.
            $groups[] = Group::create([
                'game_id' => $game->id,
                'name' => "Group $groupName",
            ]);
        }

        // Step 3: Divide players randomly into groups
        $players = $request->input('players');
        shuffle($players); // Randomize the player order

        $groupIndex = 0;
        foreach ($players as $playerId) {
            // Assign the player to the current group
            GroupPlayer::create([
                'group_id' => $groups[$groupIndex]->id,
                'player_id' => $playerId,
            ]);

            // Move to the next group (round-robin assignment)
            $groupIndex = ($groupIndex + 1) % $boardNumber;
        }

        // Step 4: Create matches based on the number of players
        $totalPlayers = count($players);

        if ($totalPlayers == 2) {
            // Only one final match
            $this->createFinalMatch($game, $players);
        } elseif ($totalPlayers == 4) {
            // Two semi-final matches and one final match
            $this->createSemiFinalMatches($game, $players);
        } else {
            // More than 4 players, create group stage matches first
            $this->createGroupStageMatches($game, $groups);
        }

        // Redirect to the tournament page
        return redirect()->route('tournament.show', ['game' => $game->id])->with('success', 'Game created successfully!');
    }

    // Helper function to create final match
    private function createFinalMatch($game, $players)
    {
        MatchGame::create([
            'game_id' => $game->id,
            'round_id' => 3, // Final
            'player1_id' => $players[0],
            'player2_id' => $players[1],
        ]);
    }

    // Helper function to create semi-final matches
    private function createSemiFinalMatches($game, $players)
    {
        MatchGame::create([
            'game_id' => $game->id,
            'round_id' => 2, // Semi Final
            'player1_id' => $players[0],
            'player2_id' => $players[1],
        ]);

        MatchGame::create([
            'game_id' => $game->id,
            'round_id' => 2, // Semi Final
            'player1_id' => $players[2],
            'player2_id' => $players[3],
        ]);
    }

    // Helper function to create group stage matches (round-robin format)
    private function createGroupStageMatches($game, $groups)
    {
        foreach ($groups as $group) {
            // Fetch all players in the current group
            $groupPlayers = GroupPlayer::where('group_id', $group->id)
                ->pluck('player_id')
                ->toArray();

            // Ensure there are at least 2 players in the group
            if (count($groupPlayers) < 2) {
                continue; // Skip groups with fewer than 2 players
            }

            // Create matches for each pair of players in the group
            for ($i = 0; $i < count($groupPlayers); $i++) {
                for ($j = $i + 1; $j < count($groupPlayers); $j++) {
                    MatchGame::create([
                        'game_id' => $game->id,
                        'round_id' => 1, // Group Stage
                        'group_id' => $group->id, // Assign the group ID
                        'player1_id' => $groupPlayers[$i],
                        'player2_id' => $groupPlayers[$j],
                    ]);
                }
            }
        }
    }

    public function showTournament($gameId)
    {
        // Fetch the game data
        $game = Game::findOrFail($gameId);

        // Fetch all matches for the game with their scores
        $matches = MatchGame::where('game_id', $gameId)
            ->with(['player1', 'player2', 'winner', 'scores'])
            ->get();

        // Fetch all groups for the game
        $groups = Group::where('game_id', $gameId)->get();

        // Fetch all rounds
        $rounds = Round::all();

        // Determine if there are any group stage matches
        $hasGroupStageMatches = $matches->where('round_id', 1)->isNotEmpty();

        // Determine if there are any semi-final matches
        $hasSemiFinalMatches = $matches->where('round_id', 2)->isNotEmpty();

        // Determine if there is a final match
        $hasFinalMatch = $matches->where('round_id', 3)->isNotEmpty();

        // Determine the winner if the final match is completed
        $winner = null;
        $finalMatch = $matches->where('round_id', 3)->first();
        if ($finalMatch && $finalMatch->winner_id) {
            $winner = $finalMatch->winner;
        }

        // Pass the data to the view
        return view('game.tournament', compact('game', 'matches', 'groups', 'rounds', 'hasGroupStageMatches', 'hasSemiFinalMatches', 'hasFinalMatch', 'winner'));
    }

    //Group Stage Score update
    public function updateScore(Request $request, $matchId)
    {
        // Validate the request
        $request->validate([
            'player1_score' => 'required|integer|min:0',
            'player2_score' => 'required|integer|min:0',
        ]);

        // Fetch the match
        $match = MatchGame::findOrFail($matchId);
        
        // Save the scores for Player 1
        Score::updateOrCreate(
            [
                'match_game_id' => $matchId, // Add match_game_id here
                'player_id' => $match->player1_id,
            ],
            [
                'score' => $request->input('player1_score'),
            ]
        );

        // Save the scores for Player 2
        Score::updateOrCreate(
            [
                'match_game_id' => $matchId, // Add match_game_id here
                'player_id' => $match->player2_id,
            ],
            [
                'score' => $request->input('player2_score'),
            ]
        );

        // Determine the winner
        $winnerId = null;
        if ($request->input('player1_score') > $request->input('player2_score')) {
            $winnerId = $match->player1_id;
        } elseif ($request->input('player2_score') > $request->input('player1_score')) {
            $winnerId = $match->player2_id;
        }

        $matchScore = $request->input('player1_score').'-'.$request->input('player2_score');

        // Update the winner_id in the match_games table
        $match->update(['winner_id' => $winnerId, 'scores'=>$matchScore]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Score saved successfully!');
    }
}