<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;
use App\src\Models\Departamento;

class Provincia extends Model
{
    protected $table = 'ubprovincia';
    protected $primary_key = 'idProv';
    
    protected $fillable = [
        'idProv',
        'provincia',
        'idDepa',
    ];

    
    public function departamento(){
        return $this->belongsTo(Departamento::class, 'idDepa', 'idDepa');
    }
}
