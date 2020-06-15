<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;

    protected $table = 'order_detail';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantify',
        'final'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function calculateSubtotal()
    {
        return ($this->final * $this->quantify);
    }

}
