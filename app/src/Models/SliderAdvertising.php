<?php

namespace App\src\Models;

use App\src\Traits\CompressImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QCod\ImageUp\HasImageUploads;

class SliderAdvertising extends Model
{
    use SoftDeletes, HasImageUploads, CompressImage;

    protected $table = 'slider_advertising';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'image_mobile',
        'image_desktop',
    ];

    protected $imagesUploadDisk = 'web';

    protected $imagesUploadPath = 'img/slider/only_img';

    protected static $imageFields = [
        'image_mobile' => [
            'rules' => 'image|max:2000',
        ],
        'image_desktop' => [
            'rules' => 'image|max:2000',
        ]
    ];

    protected function imageDesktopUploadFilePath($file)
    {
        return $this->id . '-desktop-' . $file->hashName();
    }

    protected function imageMobileUploadFilePath($file)
    {
        return $this->id . '-mobile-' . $file->hashName();
    }
}
