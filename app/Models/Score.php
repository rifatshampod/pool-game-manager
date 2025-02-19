<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['match_game_id', 'player_id', 'score'];

    // A score belongs to a match
    public function match()
    {
        return $this->belongsTo(MatchGame::class);
    }

    // A score belongs to a player
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}