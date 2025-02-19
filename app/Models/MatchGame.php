<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchGame extends Model
{
    use HasFactory;
    
    protected $fillable = ['game_id', 'round_id', 'group_id', 'player1_id', 'player2_id','scores', 'winner_id'];

    // A match belongs to a game
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    // A match has two players (player1 and player2)
    public function player1()
    {
        return $this->belongsTo(Player::class, 'player1_id');
    }

    public function player2()
    {
        return $this->belongsTo(Player::class, 'player2_id');
    }

    // Match of which Round 
    public function round()
    {
        return $this->belongsTo(Round::class, 'round_id');
    }

    // Match of which Group 
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    // A match has one winner (player)
    public function winner()
    {
        return $this->belongsTo(Player::class, 'winner_id');
    }

    // A match has many scores
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}