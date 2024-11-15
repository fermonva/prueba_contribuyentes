<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    /**
     * Create a new class instance.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        try {
            return $this->model->create($data);
        }catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update($model, array $data)
    {
        try {
            $model->update($data);
            return $model;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function delete($id)
    {
        $model = $this->find($id);
        $model->delete();
        return $model;
    }
}
