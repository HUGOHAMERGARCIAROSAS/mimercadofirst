<?php

namespace App\src\Repositories;

use App\src\Models\ShippingCost;
use App\src\Repositories\Base\BaseRepository;
use App\src\Util\Constants;
use Illuminate\Support\Collection;

class ShippingCostRepository extends BaseRepository
{
    protected $model;

    public function __construct(ShippingCost $shippingCost)
    {
        $this->model = $shippingCost;
    }

    public function listShippingCostWithOrder($order = 'id', $sort = 'desc', $except = []): Collection
    {
        $costOrder = $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->where('order', '<>', null)
            ->orderBy('order', 'asc')->get()->except($except);

        $costWithWithoutOrder = $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->orderBy('id', 'desc')->get()->except($except);

        return $costOrder->merge($costWithWithoutOrder);
    }

    public function delete(): bool
    {
        return $this->model->update([
            'state' => Constants::ESTADO_ELIMINADO
        ]);
    }

    public function updateItemInTable($column, $value)
    {
        return $this->model
            ->update([
                $column => $value,
            ]);
    }


}