<?php

namespace App\src\Models;

use App\src\Traits\CompressImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QCod\ImageUp\HasImageUploads;

class Comment extends Model
{
    use SoftDeletes, HasImageUploads, CompressImage;

    protected $table = 'comment';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user',
        'comment',
        'image',
    ];

    protected $imagesUploadDisk = 'web';

    protected $imagesUploadPath = 'img/comment';

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
