<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    const ESTADO_UTILIZADO = "U";
    const ESTADO_SIN_UTILIZAR = "SU";

    protected $table = 'coupon';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code',
        'discount',
        'state',
        'active',
    ];

}
