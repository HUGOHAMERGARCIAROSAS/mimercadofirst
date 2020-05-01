<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUnitMeasure extends Model
{
    protected $table = 'product_unit_measure';

    protected $fillable = [
        'name',
        'abrv',
        'state',
    ];

}
