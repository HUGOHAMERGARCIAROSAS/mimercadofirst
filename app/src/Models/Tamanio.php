<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tamanio extends Model
{

    protected $table = 'tamaño';


    protected $fillable = [
        'nombre',
    ];

}
