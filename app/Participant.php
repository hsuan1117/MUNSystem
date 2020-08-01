<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $primaryKey = 'conference_id';
    protected $casts = [
        'chairs'=>"array",
    ];
    protected $fillable = [
        'chairs',

    ];
}
