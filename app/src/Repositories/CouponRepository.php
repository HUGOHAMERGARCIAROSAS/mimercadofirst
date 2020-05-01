<?php

namespace App\src\Repositories;

use App\src\Models\Coupon;
use App\src\Repositories\Base\BaseRepository;
use App\src\Util\Constants;

class CouponRepository extends BaseRepository
{
    public function __construct(Coupon $coupon)
    {
        parent::__construct($coupon);
        $this->model = $coupon;
    }

    public function all($columns = array('*'), $orderBy = 'id', $sortBy = 'DESC')
    {
        return $this->model
            ->orderBy($orderBy, $sortBy)
            ->where('active', Constants::ESTADO_ACTIVO)
            ->get();
    }

    public function delete(): bool
    {
        return $this->model->update([
            'active' => Constants::ESTADO_ELIMINADO,
        ]);
    }

}