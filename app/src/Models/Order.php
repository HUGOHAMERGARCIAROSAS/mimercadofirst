<?php

namespace App\src\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'order';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'payment_method',
        'address',
        'reference',
        'transfer_code',
        'state',
        'shipping_cost_id',
        'user_id',
        'coupon_code',
        'culqui_order_id',
    ];

    public static $PAYMENT_METHOD_BANK_TRANSFER = "Transferencia Bancaria";

    public static $PAYMENT_METHOD_PAYMENT_ONLINE = "Pago Online";

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function shippingCost()
    {
        return $this->belongsTo(ShippingCost::class, 'shipping_cost_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function calculateTotal(Order $order)
    {
        $total = 0.0;
        foreach ($order->orderDetail as $item) {
            $total += $item->calculateSubtotal();
        }

        return ($total + $order->shippingCost->cost);
    }

}
