<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'title','password'
    ];
}
