<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billings extends Model
{
    protected $fillable = [
        'order_status'
    ];

    function product(){
        return $this->belongsTo('App\Product');
    }

    function user(){
        return $this->belongsTo('App\User');
    }

    function shipping(){
        return $this->belongsTo('App\Shipping');
    }

    
}
