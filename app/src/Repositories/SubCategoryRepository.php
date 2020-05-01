<?php

namespace App\src\Repositories;

use App\src\Models\SubCategory;
use App\src\Repositories\Base\BaseRepository;
use App\src\Util\Constants;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class SubCategoryRepository extends BaseRepository
{
    public function __construct(SubCategory $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function delete(): bool
    {
        return $this->model->update([
            'state' => Constants::ESTADO_ELIMINADO
        ]);
    }

    public function allWithEstateActive($orderBy = 'id', $sortBy = 'DESC')
    {
        $except = [];

        $inOrder = $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->where('order', '<>', null)
            ->orderBy('order', 'asc')
            ->get()->except($except);

        $withoutOrder = $this->model
            ->where('state', Constants::ESTADO_ACTIVO)
            ->orderBy('id', 'desc')
            ->get()->except($except);

        return $inOrder->merge($withoutOrder);
    }

    public function changeOrder($id, $position)
    {
        $category = $this->model->find($id);

        $findPosition = $this->model->where('order', $position)->first();

        if (!empty($findPosition)) {
            $findPosition->update([
                'order' => NULL,
            ]);
        }

        return $category->update([
            'order' => $position,
        ]);
    }

    public function updateItemInTable($column, $value)
    {
        return $this->model
            ->update([
                $column => $value,
                'slug' => Str::slug($value),
            ]);
    }

    public function searchSubCategories($categoryId)
    {
        return $this->model
            ->where('category_id', $categoryId)
            ->where('state', Constants::ESTADO_ACTIVO)
            ->get();
    }

    public function hasProductSubCategories()
    {
        return $this->model
            ->countProductSubCategories();
    }

}