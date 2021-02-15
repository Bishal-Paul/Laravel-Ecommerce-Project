<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_name',
        'slug',
        'category_id',
        'subcategory_id',
        'product_price',
        'discount_price',
        'product_quantity',
        'product_summary',
        'product_description',
        'product_size',
        'product_color',
        'product_thumbnail',
        'product_status'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function productimage()
    {
        return $this->belongsTo('App\ProductImage');
    }

    public function billings()
    {
        return $this->hasOne('App\Billings');
    }
}
