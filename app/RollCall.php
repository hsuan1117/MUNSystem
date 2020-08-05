<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RollCall extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'role',
        'status'
    ];
    /* *
     * | id | role | status |
     * |       1       | chairs |   PV   |
     * |       1       | Japan  |   P   |
     * |       1       | China  |   A   |
     * */
}
