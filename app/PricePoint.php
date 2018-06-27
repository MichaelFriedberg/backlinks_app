<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricePoint extends Model
{
    /**
     * Attributes that are fillable
     *
     * @var array
     */
    protected $fillable = [
        'from',
        'to',
        'price'
    ];

    /**
     * Get name attribute
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->from . '-' . $this->to . ': $' . $this->price;
    }

    /**
     * Get price for given score
     *
     * @param $score
     * @return int
     */
    public static function forScore($score)
    {
        $pricePoint = static::where('from', '<=', $score)
            ->where('to', '>=', $score)
            ->first();

        if (! $pricePoint) {
            return 0;
        }

        return $pricePoint->price;
    }
}
