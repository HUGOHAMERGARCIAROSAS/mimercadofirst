<?php

namespace App\src\Repositories;

use App\src\Models\Recipe;
use App\src\Repositories\Base\BaseRepository;

class RecipeRepository extends BaseRepository
{
    public function __construct(Recipe $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

}