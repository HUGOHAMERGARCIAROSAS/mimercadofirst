<?php

namespace App\src\Repositories;

use App\src\Models\ProductScale;
use App\src\Repositories\Base\BaseRepository;

class ProductScaleRepository extends BaseRepository
{
    public function __construct(ProductScale $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

}