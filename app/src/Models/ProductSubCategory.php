<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    protected $table = 'product_sub_category';

    protected $fillable = [
        'order',
        'name',
        'slug',
        'state',
        'sub_category_id',
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'product_sub_category_id');
    }

    public function countProducts()
    {
        return $this->hasMany(Product::class,'product_sub_category_id')->count();
    }

}
