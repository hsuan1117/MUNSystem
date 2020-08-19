<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amendment extends Model
{
    protected $table = 'amendments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'role',
        'article',
        'title',
        'accept'
    ];
    /* Accept:
     *  true
     *  pending
     *  false
     * */
}
