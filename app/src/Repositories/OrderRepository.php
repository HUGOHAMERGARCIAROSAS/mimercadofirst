<?php

namespace App\src\Repositories;

use App\src\Models\Order;
use App\src\Repositories\Base\BaseRepository;
use App\src\Util\Constants;

class OrderRepository extends BaseRepository
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function delete(): bool
    {
        return $this->model->update([
            'state' => Constants::ESTADO_ELIMINADO
        ]);
    }
}