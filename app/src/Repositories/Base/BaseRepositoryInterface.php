<?php

namespace App\src\Repositories\Base;

interface BaseRepositoryInterface
{
    public function create(array $attributes);

    public function update(array $attributes): bool;

    public function all($columns = array('*'), $orderBy = 'id', $sortBy = 'DES');

    public function find($id);

    public function findOneOrFail($id);

    public function findBy(array $data);

    public function findOneBy(array $data);

    public function findOneByOrFail(array $data);

    public function delete(): bool;

    public function paginateArrayResults(array $data, $perPage = 50);

    public function allWithEstateActive($orderBy = 'id', $sortBy = 'asc');

}