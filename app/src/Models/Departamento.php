<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'ubdepartamento';
    protected $primary_key = 'idDepa';

    protected $fillable = [
        'idDepa',
        'departamento'
    ];

}
