<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'payment_status'
    ];

    function division(){
        
        return $this->belongsToMany('App\Division');
    }
}
