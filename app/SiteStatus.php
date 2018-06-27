<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteStatus extends Model
{
    /**
     * Attributes that are mass-assignable
     *
     * @var array
     */
    protected $fillable = [
        'site_id',
        'status'
    ];
}
