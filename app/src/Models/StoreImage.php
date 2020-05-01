<?php

namespace App\src\Models;

use App\src\Traits\CompressImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QCod\ImageUp\HasImageUploads;

class StoreImage extends Model
{
    use HasImageUploads, CompressImage, Sluggable;

    const ESTADO_HABILITADO = "HA";
    const ESTADO_INHABILITADO = "IN";

    protected $table = 'store_image';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'image',
        'slug',
        'state_image',
    ];

    protected $imagesUploadDisk = 'web';

    protected $imagesUploadPath = 'img/storeImage';

    protected static $imageFields = [
        'image' => [
            'rules' => 'image|max:2000',
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

    public function getImage()
    {
        return $this->image;
    }

}
