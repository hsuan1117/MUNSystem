<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'conf_id',
        'role',
        'recipient',
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
