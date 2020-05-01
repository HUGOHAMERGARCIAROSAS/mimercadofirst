<?php

namespace App\src\Models;
use App\src\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Order_provider extends Model
{
    protected $table = 'order_provider';


    protected $fillable = [
        'id_product',
        'id_provider',
    ];


    public function user()
    {
        return $this->belongsTo(Admin::class);
    }
    public function producto()
    {
        return $this->belongsTo(Product::class,'id_product');
    }
}
