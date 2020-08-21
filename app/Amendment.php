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
        'accept',
        'method'
    ];
    /* Accept:
     *  true
     *  pending
     *  false
     * */
}
