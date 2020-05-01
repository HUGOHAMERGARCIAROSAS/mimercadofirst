<?php

namespace App\src\Repositories;

use App\src\Models\Subscriber;
use App\src\Repositories\Base\BaseRepository;

class SubscriberRepository extends BaseRepository
{
    protected $model;

    public function __construct(Subscriber $model)
    {
        $this->model = $model;
    }
    
     public function listSubscriberByOrder()
    {
        return $this->model
            ->orderBy('id', 'ASC')
            ->get();
    }

}