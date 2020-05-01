<?php

namespace App\src\Repositories\Contracts;

use App\src\Repositories\Base\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function ultimosRegistros($numeroDeRegistros);
}