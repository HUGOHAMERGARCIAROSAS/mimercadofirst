<?php

namespace App\src\Repositories;

use App\src\Models\StoreImage;
use App\src\Repositories\Base\BaseRepository;

class StoreImageRepository extends BaseRepository
{
    public function __construct(StoreImage $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

}