<?php

namespace App\src\Models;

use App\src\Traits\CompressImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QCod\ImageUp\HasImageUploads;

class Recipe extends Model
{
    use SoftDeletes, HasImageUploads, CompressImage;

    protected $table = 'recipe';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'image',
        'date',
    ];

    protected $imagesUploadDisk = 'web';

    protected $imagesUploadPath = 'img/recipe';

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
