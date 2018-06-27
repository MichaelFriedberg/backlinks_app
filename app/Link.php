<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * Attributes that are fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url'
    ];
}
