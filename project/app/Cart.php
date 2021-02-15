<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function flashsaleproduct()
    {
        return $this->belongsTo('App\FlashSale');
    }
}
