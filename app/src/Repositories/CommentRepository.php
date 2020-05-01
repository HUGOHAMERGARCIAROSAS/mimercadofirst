<?php

namespace App\src\Repositories;

use App\src\Models\Comment;
use App\src\Repositories\Base\BaseRepository;

class CommentRepository extends BaseRepository
{
    protected $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

}