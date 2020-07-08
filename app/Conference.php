<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    //
    protected $casts = [
        'chairs' => 'array'
    ];
    protected $fillable = [
        'title',
        'chairs'
    ];
}
