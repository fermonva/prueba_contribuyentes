<?php

namespace App\Repositories;

use App\Interfaces\ContribuyenteRepositoryInterface;
use App\Models\Contribuyente;

class ContribuyenteRepository extends BaseRepository implements ContribuyenteRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(Contribuyente $model)
    {
        parent::__construct($model);
    }

    public function paginateAll(array $filters = [], $perPage = 10)
    {
        $query = $this->model->query();

        // Aplicar filtros si están presentes
        if (!empty($filters['tipo_documento'])) {
            $query->where('tipo_documento', 'LIKE', "%{$filters['tipo_documento']}%");
        }
        if (!empty($filters['documento'])) {
            $query->where('documento', 'LIKE', "%{$filters['documento']}%");
        }
        if (!empty($filters['nombres'])) {
            $query->where('nombres', 'LIKE', "%{$filters['nombres']}%");
        }
        if (!empty($filters['apellidos'])) {
            $query->where('apellidos', 'LIKE', "%{$filters['apellidos']}%");
        }
        if (!empty($filters['telefono'])) {
            $query->where('telefono', 'LIKE', "%{$filters['telefono']}%");
        }
        return $query->paginate($perPage);
    }
}
