<?php

namespace App\src\Traits;

use yasmuru\LaravelTinify\Facades\Tinify;
use Log;

trait CompressImage
{
    protected $pathCompressImage = "web/";

    public function compressImage($hasImage)
    {
        try {
            if ($hasImage) {
                $path = public_path($this->pathCompressImage . self::getImage());
                $result = Tinify::fromFile($path);
                $result->toFile($path);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function compressImages($hasImage, $route)
    {
        try {
            if ($hasImage) {
                $path = public_path($this->pathCompressImage . $route);
                $result = Tinify::fromFile($path);
                $result->toFile($path);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }


}