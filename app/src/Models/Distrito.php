<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;
use App\src\Models\Provincia;

class Distrito extends Model
{
    protected $table = 'ubdistrito';
    protected $primary_key = 'idDist';
    
    protected $fillable = [
        'idDist',
        'distrito',
        'idProv',
    ];

    public function provincia(){
        return $this->belongsTo(Provincia::class, 'idProv', 'idProv');
    }


}

