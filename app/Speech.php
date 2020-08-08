<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speech extends Model
{
    protected $table = 'speeches';
    protected $primaryKey = 'id';
    protected $fillable = [
        'role',
        'article',
        'start'
    ];
    /* *
     * | id | role | status |
     * |       1       | chairs |   PV   |
     * |       1       | Japan  |   P   |
     * |       1       | China  |   A   |
     * */
}
