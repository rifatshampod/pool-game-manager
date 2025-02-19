<?php

// app/Models/Group.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'name'];

    // A group belongs to a game
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    // A group has many players
    public function players()
    {
        return $this->belongsToMany(Player::class, 'group_players');
    }
}