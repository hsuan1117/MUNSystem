<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'conf_id',
        'vote_id',
        'role',
        'voting'
    ];
    /* *
     * | id | role | status |
     * |       1       | chairs |   PV   |
     * |       1       | Japan  |   P   |
     * |       1       | China  |   A   |
     * */
}
