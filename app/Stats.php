<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'site', 'tag', 'impressions', 'served', 'fill', 'income', 'ecpm',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];
}
