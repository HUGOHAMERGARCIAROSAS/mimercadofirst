<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class ProductScale extends Model
{
    public static $SCALE_INTEGER = "scale_integer";
    public static $SCALE_DECIMAL = "scale_decimal";
    public static $SCALE_ONE = "scale_one";
    public static $SCALE_ZERO_TWO = "scale_zero_two";
    public static $SCALE_ZERO_FIVE = "scale_zero_five";
    public static $SCALE_SIX = "scale_six";
    public static $SCALE_TWELVE = "scale_twelve";
    public static $SCALE_TWENTY_FIVE = "scale_twenty_five";
    public static $SCALE_FIFTY = "scale_fifty";
    public static $SCALE_ONE_HUNDRED = "scale_one_hundred";

    protected $table = 'product_scale';

    protected $fillable = [
        'name',
        'value',
    ];

}
