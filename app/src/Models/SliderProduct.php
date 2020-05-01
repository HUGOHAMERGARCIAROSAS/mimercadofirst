<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QCod\ImageUp\HasImageUploads;

class SliderProduct extends Model
{
    use SoftDeletes, HasImageUploads;

    protected $table = 'slider_product';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'background',
        'product_id',
    ];

    protected $imagesUploadDisk = 'web';

    protected $imagesUploadPath = 'img/slider/product';

    protected static $imageFields = [
        'background' => [
            'rules' => 'image|max:2000',
        ]
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
