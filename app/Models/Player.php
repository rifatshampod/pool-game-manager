<?php

// app/Models/Player.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // A player can belong to many groups
    // public function groups()
    // {
    //     return $this->belongsToMany(Group::class, 'group_players');
    // }

    // A player can participate in many matches as player1
    // public function matchesAsPlayer1()
    // {
    //     return $this->hasMany(Match::class, 'player1_id');
    // }

    // A player can participate in many matches as player2
    // public function matchesAsPlayer2()
    // {
    //     return $this->hasMany(Match::class, 'player2_id');
    // }

    // A player can have many scores
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}