<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class Category_prov extends Model
{
    protected $table = 'category_proveedor';

    protected $fillable = [
        'order',
        'name',
        'slug',
        'state',
        'imagen',
    ];

  public function subCategories()
    {
       return $this->hasMany(SubCategory::class);
    }

    public function existCategory($category, $categoryId)
    {
        return ($category->id == $categoryId);
    }

}
