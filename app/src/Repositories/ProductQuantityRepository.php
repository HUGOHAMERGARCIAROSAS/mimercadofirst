<?php

namespace App\src\Repositories;

use App\src\Models\ProductQuantity;
use App\src\Repositories\Base\BaseRepository;

class ProductQuantityRepository extends BaseRepository
{
    public function __construct(ProductQuantity $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

}