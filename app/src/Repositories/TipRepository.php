<?php

namespace App\src\Repositories;

use App\src\Models\Tip;
use App\src\Repositories\Base\BaseRepository;
use Illuminate\Support\Collection;

class TipRepository extends BaseRepository
{
    protected $model;

    public function __construct(Tip $model)
    {
        $this->model = $model;
    }

    public function listTips($order = 'id', $sort = 'desc', $except = []): Collection
    {
        return $this->model->orderBy($order, $sort)->get()->except($except);
    }
}