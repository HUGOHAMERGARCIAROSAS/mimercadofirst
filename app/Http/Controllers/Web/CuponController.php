<?php

namespace App\Http\Controllers\Web;

use App\src\Models\Coupon;
use App\src\Repositories\CouponRepository;
use App\Http\Controllers\Controller;
use App\src\Util\CartMessage;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Exception;
use Log;

class CuponController extends Controller
{
    private $couponRepository;

    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function couponCode(Request $request)
    {
        $code = $request->input('code');

        $coupon = $this->couponRepository->findOneBy([
            'code' => $code,
            'state' => Coupon::ESTADO_SIN_UTILIZAR,
        ]);

        if (!$coupon) {
            return redirect()->back()->withErrors(['messageCoupon' => CartMessage::incorrectCoupon()]);
        }

        $total = Cart::subtotal() - $coupon->discount;
        if ($total < 0) {
            return redirect()->back()->withErrors(['messageCoupon' => CartMessage::discountCouponExceed()]);
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $coupon->discount,
        ]);

        return redirect()->back()->with([
            'messageCoupon' => CartMessage::correctCoupon(),
        ]);
    }

    public function destroy()
    {
        session()->forget('coupon');

        return back()->with('messageCoupon', CartMessage::removeCoupon());
    }

}
