<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    // A player can participate in many matches as player1
    public function matches()
    {
        return $this->hasMany(MatchGame::class, 'player1_id');
    }
}