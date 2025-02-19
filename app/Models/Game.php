<?php

// app/Models/Game.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'total_players','total_boards', 'winner_id'];

    // A game has many groups
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    // A game has many matches
    public function matches()
    {
        return $this->hasMany(MatchGame::class);
    }

    // A game has one winner (player)
    public function winner()
    {
        return $this->belongsTo(Player::class, 'winner_id');
    }
}