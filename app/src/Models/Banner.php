<?php

namespace App\src\Models;

use App\src\Traits\CompressImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QCod\ImageUp\HasImageUploads;

class Banner extends Model
{
    use SoftDeletes, HasImageUploads, CompressImage;

    const ESTADO_BANNER_HABILITADO = "HA";
    const ESTADO_BANNER_INHABILITADO = "IN";

    protected $table = 'banner';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'image',
        'state_image',
    ];

    protected $imagesUploadDisk = 'web';

    protected $imagesUploadPath = 'img/banner';

    protected static $imageFields = [
        'image' => [
            'rules' => 'image|max:2000',
        ]
    ];

    public function getImage()
    {
        return $this->image;
    }

}
