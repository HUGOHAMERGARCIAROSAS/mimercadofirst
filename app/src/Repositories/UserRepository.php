<?php

namespace App\src\Repositories;

use App\src\Repositories\Base\BaseRepository;
use App\User;

class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

}