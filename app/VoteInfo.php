<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteInfo extends Model
{
    protected $table = 'vote_info';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title'
    ];
}
