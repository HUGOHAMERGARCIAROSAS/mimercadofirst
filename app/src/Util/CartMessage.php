<?php

namespace App\src\Util;


class CartMessage
{
    public static function incorrectCoupon()
    {
        return "Cupón incorrecto";
    }

    public static function correctCoupon()
    {
        return "El Cupón ha sido aplicado!";
    }

    public static function discountCouponExceed()
    {
        return "El cupón de descuento supera el total. Agrege más productos al carrito.";
    }

    public static function removeCoupon()
    {
        return "El cupón ha sido removido.";
    }

    public static function minimumAmountOfPurchase()
    {
        return "Para seguir con la compra, el total debe ser mayor a S/ 10.00";
    }
}