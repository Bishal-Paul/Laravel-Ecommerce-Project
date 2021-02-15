<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $fillable = [
        'email1',
        'email2',
        'number1',
        'number2',
        'number3',
        'road_no',
        'city',
        'country',
        'description',
    ];
}
