<?php

namespace App\Repositories;

use App\Exceptions\ModelNotFoundException;
use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    /**
     * Create a new class instance.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): iterable
    {
        return $this->model->all();
    }

    public function find(int|string $id): ?Model
    {
        $model = $this->model->findorFail($id);

        if (!$model) {
            throw new ModelNotFoundException("Modelo no encontrado con ID {$id}.");
        }

        return $model;
    }

    public function create(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            return $this->model->create($data);
        });
    }

    public function update(Model $model, array $data): bool
    {
        return DB::transaction(function () use ($model, $data) {
            return $model->update($data);
        });
    }

    public function delete(Model $model): bool
    {
        return DB::transaction(function () use ($model) {
            return $model->delete();
        });
    }

    public function paginate(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->query();

        // Aplicar filtros genéricos
        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $query->where($key, 'LIKE', "%$value%");
            }
        }

        return $query->paginate($perPage);
    }
}
