<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'order',
        'name',
        'slug',
        'state',
        'imagen',
    ];

    public static $CATEGORY_FRUTAS = "1";
    public static $CATEGORY_ABARROTES = "2";
    public static $CATEGORY_BABYS = "3";
    public static $CATEGORY_LIMPIEZA = "4";
    public static $CATEGORY_CUIDADO_PERSONAL = "5";
    public static $CATEGORY_MASCOTAS = "6";
    public static $CATEGORY_BEBIDAS_LICORES = "7";
    public static $CATEGORY_OTROS = "8";
    public static $CATEGORY_SLUG_FRUTAS = "frutas";
    public static $CATEGORY_SLUG_ABARROTES = "abarrotes";
    public static $CATEGORY_SLUG_BABYS = "babys-kids";
    public static $CATEGORY_SLUG_LIMPIEZA = "limpieza";
    public static $CATEGORY_SLUG_CUIDADDO_PERSONAL = "cuidado-personal";
    public static $CATEGORY_SLUG_MASCOTAS = "mascotas";
    public static $CATEGORY_SLUG_BEBIDAS_LICORES = "bebidas-y-licores";
    public static $CATEGORY_SLUG_OTROS = "otros";

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function existCategory($category, $categoryId)
    {
        return ($category->id == $categoryId);
    }

}
