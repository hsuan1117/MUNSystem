<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $primaryKey = 'conference_id';
    protected $fillable = [
        'title'
    ];
}
