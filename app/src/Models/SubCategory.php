<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_category';

    protected $fillable = [
        'name',
        'slug',
        'state',
        'category_id',
        'imagen',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function productSubCategories()
    {
        return $this->hasMany(ProductSubCategory::class, 'sub_category_id');
    }

    public function countProductSubCategories()
    {
        return $this->hasMany(ProductSubCategory::class,'sub_category_id')->count();
    }

}
