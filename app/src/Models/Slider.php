<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;

    protected $table = 'slider';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code_slider_advertising',
        'code_slider_product',
        'is_advertising',
        'available',
        'state',
    ];

    protected $casts = [
        'is_advertising' => 'boolean',
        'available' => 'boolean',
    ];

    public function sliderAdvertising()
    {
        return $this->belongsTo(SliderAdvertising::class, 'code_slider_advertising');
    }

    public function sliderProduct()
    {
        return $this->belongsTo(SliderProduct::class, 'code_slider_product');
    }

    public function allAvailable(){
        return self::where('available','1')->get();
    }

}
