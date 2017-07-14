<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService implements BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $this->model->find($id)->update($attributes);
    }

    public function delete($id)
    {
        $this->model->delete($id);
    }

    public function deleteByColumn($column, $value){
        $record = $this->model->where($column, $value)->delete();
    }

    public function getByColumn($column, $value){
        return $this->model->where($column, $value)->first();
    }

    public function getAllByColumn($column, $value){
        return $this->model->where($column, $value)->get();
    }

    public function updateByColumn($column, $value, array $attributes)
    {
        $this->model->where($column, $value)->update($attributes);
    }

}
