<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_name',
        'category_image'
    ];

    public function subcategory()
    {
        return $this->hasMany('App\SubCategory');
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }

}
