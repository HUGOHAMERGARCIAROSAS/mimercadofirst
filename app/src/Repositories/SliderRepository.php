<?php

namespace App\src\Repositories;

use App\src\Models\Slider;
use App\src\Repositories\Base\BaseRepository;
use App\src\Util\Constants;

class SliderRepository extends BaseRepository
{
    public function __construct(Slider $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

//    public function allWithEstateActive($orderBy = 'id', $sortBy = 'DESC')
//    {
//        return $this->model
//            ->where('state', Constants::ESTADO_ACTIVO)
//            ->whereHas('product', function ($q) {
//                $q->where('state', Constants::ESTADO_ACTIVO);
//            })->get();
//    }
//
    public function allAvailable($orderBy = 'id', $sortBy = 'DESC')
    {
        return $this->model
            ->where('available', 1)
            ->where('state', Constants::ESTADO_ACTIVO)
//            ->whereHas('product', function ($q) {
//                $q->where('state', Constants::ESTADO_ACTIVO);
//            })
            ->get();
    }

//
//    public function delete(): bool
//    {
//        return $this->model->update([
//            'state' => Constants::ESTADO_ELIMINADO
//        ]);
//    }

}