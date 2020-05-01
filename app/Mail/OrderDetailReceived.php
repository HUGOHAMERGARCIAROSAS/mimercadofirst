<?php

namespace App\Mail;

use App\src\Models\Coupon;
use App\src\Models\Order;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderDetailReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;

    public function __construct(Order $order, User $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Felicitaciones por su compra';

        $coupon = Coupon::where('code', $this->order->coupon_code)->first();

        $discount = ($coupon != null) ? $coupon->discount : 0.0;
        $shippingCost = $this->order->shippingCost->cost;

        $calculateSubTotal = 0.0;
        foreach ($this->order->orderDetail as $detail) {
            $calculateSubTotal += ($detail->final * $detail->quantify);
        }

        $calculateTotal = (($calculateSubTotal - $discount) + $shippingCost);

        return $this
            ->markdown('emails.orders.order_detail_editor')
            ->subject($subject)
            ->with([
                'subtotal' => priceFormat($calculateSubTotal),
                'orderTotal' => priceFormat($calculateTotal),
                'discount' => priceFormat($discount),
                'shippingCost' => priceFormat($shippingCost),
            ]);
    }
}
