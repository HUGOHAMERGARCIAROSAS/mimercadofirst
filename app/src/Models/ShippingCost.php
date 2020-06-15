<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;
use App\src\Models\Distrito;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingCost extends Model
{
    use SoftDeletes;

    protected $table = 'shipping_cost';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'distrito_id',
        'zona',
        'cost',
        'state',
        'order',
    ];

    
    public function distrito(){
        return $this->belongsTo(Distrito::class, 'distrito_id', 'idDist');
    }
}
