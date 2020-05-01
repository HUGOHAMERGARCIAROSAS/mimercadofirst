<?php

namespace App\src\Models;

use App\src\Traits\CompressImage;
use App\src\Util\Constants;
use App\Admin;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use QCod\ImageUp\HasImageUploads;

class Product extends Model
{
    use SoftDeletes, HasImageUploads, CompressImage, Sluggable;

    protected $table = 'product';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'slug',
        'price',
        'image',
        'state',
        'orden',
        'disponible',
        'product_today',
        'description',
        'porcentaje',
        'monto',
        'final',
        'product_unit_measure_id',
        'product_scale_id',
        'product_sub_category_id',
        'provider_id'
    ];

    protected $imagesUploadDisk = 'web';

    protected $imagesUploadPath = 'img/product';

    protected static $imageFields = [
        'image' => [
            'rules' => 'image|max:2000',
            'auto_upload' => false,
        ]
    ];
    
    
    protected function imageUploadFilePath($file)
    {
        return $this->slug ."-MiMercado.delivery". "." . $file->getClientOriginalExtension();
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'provider_id');
    }
    public function productUnitMeasure()
    {
        return $this->belongsTo(ProductUnitMeasure::class, 'product_unit_measure_id');
    }

    public function productScale()
    {
        return $this->belongsTo(ProductScale::class);
    }

    public function slider()
    {
        return $this->hasOne(Slider::class);
    }

    public function productSubCategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'product_sub_category_id');
    }

    public function countProductInOrder()
    {
        return $this->hasMany(Order::class,'sub_category_id')->count();
    }

    public function searchProduct(string $term): Collection
    {
        return self::where('state', Constants::ESTADO_ACTIVO)
            ->where(function ($query) use ($term) {
                $query->where('name', 'like', "%$term%")
                ->orWhere('description', 'like', "%$term%");
            })
            ->where('disponible', 'SI')
            ->where('state', Constants::ESTADO_ACTIVO)
            ->get();
    }

    // only in 0.5, 0.25
    public function calculatePriceByKg(Product $product)
    {
        $final = $product->final;

        if ($product->productScale->name == ProductScale::$SCALE_ZERO_FIVE) {
            $final = ($product->final * 2);
        } else if ($product->productScale->name == ProductScale::$SCALE_ZERO_TWO) {
            $final = ($product->final * 4);
        }

        return priceInSole($final);
    }

    public function formatProductToday($productToday)
    {
        return ($productToday == 0) ? 'NO' : 'SI';
    }

    public function getImage()
    {
        return $this->image;
    }

}
