<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingCost extends Model
{
    use SoftDeletes;

    protected $table = 'shipping_cost';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'urbanization',
        'cost',
        'state',
        'order',
    ];
}
