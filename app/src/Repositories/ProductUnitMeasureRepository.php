<?php

namespace App\src\Repositories;

use App\src\Models\ProductUnitMeasure;
use App\src\Repositories\Base\BaseRepository;

class ProductUnitMeasureRepository extends BaseRepository
{
    public function __construct(ProductUnitMeasure $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

}