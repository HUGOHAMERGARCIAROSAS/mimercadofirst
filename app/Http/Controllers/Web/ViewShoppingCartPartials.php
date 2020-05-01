<?php

namespace App\Http\Controllers\Web;


class ViewShoppingCartPartials
{
    public static function viewShoppingCartInHeader()
    {
        return view('web.layouts._shoppingCartInHeader')->render();
    }

    public static function viewCartItems()
    {
        return view('web.layouts._cart_items')->render();
    }

    public static function viewCartCalculationDetails()
    {
        return view('web.layouts._cart_calculation_details')->render();
    }

    public static function viewCartInfo()
    {
        return view('web.layouts._cart_info')->render();
    }

    public static function viewContainerCart($cartSubtotal, $discount, $cartTotal)
    {
        return view('web.pages.cart.containerCart')
            ->with([
                'cartSubTotal' => $cartSubtotal,
                'discount' => $discount,
                'cartTotal' => $cartTotal,
            ])
            ->render();
    }

    public static function viewCartSummary($cartSubtotal, $discount, $cartTotal)
    {
        return view('web.pages.cart.cartSummary')
            ->with([
                'cartSubTotal' => $cartSubtotal,
                'discount' => $discount,
                'cartTotal' => $cartTotal,
            ])
            ->render();
    }

    public static function views($cartSubtotal, $discount, $cartTotal)
    {
        return [
            'viewShoppingCartInHeader' => self::viewShoppingCartInHeader(),
            'viewContainerCart' => self::viewContainerCart($cartSubtotal, $discount, $cartTotal),
            'viewCartSummary' => self::viewCartSummary($cartSubtotal, $discount, $cartTotal),

            'cartTotal' => $cartTotal,
        ];
    }

}