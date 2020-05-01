<?php

namespace App\src\Repositories\Base;

use App\src\Util\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes): bool
    {
        return $this->model->update($attributes);
    }

    public function all($columns = array('*'), $orderBy = 'id', $sortBy = 'DESC')
    {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOneOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findBy(array $data)
    {
        return $this->model->where($data)->get();
    }

    public function findOneBy(array $data)
    {
        return $this->model->where($data)->first();
    }

    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)->firstOrFail();
    }

    public function delete(): bool
    {
        return $this->model->delete();
    }

    public function paginateArrayResults(array $data, $perPage = 50)
    {
        $page = Input::get('page', 1);
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            array_slice($data, $offset, $perPage, true),
            count($data),
            $perPage,
            $page,
            [
                'path' => app('request')->url(),
                'query' => app('request')->query()
            ]
        );
    }

    public function allWithEstateActive($orderBy = 'id', $sortBy = 'DESC')
    {
        return $this->model->where('state', Constants::ESTADO_ACTIVO)->orderBy($orderBy, $sortBy)->get();
    }

}