<?php

// app/Models/GroupPlayer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPlayer extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'player_id'];
}