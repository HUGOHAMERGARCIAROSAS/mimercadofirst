<?php

namespace App\src\Repositories;

use App\src\Models\Banner;
use App\src\Repositories\Base\BaseRepository;

class BannerRepository extends BaseRepository
{
    protected $model;

    public function __construct(Banner $model)
    {
        $this->model = $model;
    }

}