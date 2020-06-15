<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = "galeries";

    protected $fillable = [
        'img',
        'producto_id',
    ];
}
