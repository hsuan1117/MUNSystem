<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'role',
        'account'
    ];
    /* *
     * | id | role | account |
     * |       1       | chairs |   1   |
     * |       1       | chairs |   2   |
     * |       1       | Japan  |   3   |
     * |       1       | China  |   4   |
     * */
}
