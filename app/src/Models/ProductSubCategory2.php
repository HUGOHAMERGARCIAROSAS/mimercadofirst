<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory2 extends Model
{
    protected $table = 'product_sub_category2';

    protected $fillable = [
        'order',
        'name',
        'slug',
        'state',
        'product_sub_category_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
