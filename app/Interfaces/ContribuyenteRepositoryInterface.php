<?php

namespace App\Interfaces;

interface ContribuyenteRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Paginate all Contribuyentes with optional filters.
     *
     * @param array $filters Array of filters to apply
     * @param int $perPage Number of items per page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateAll(array $filters = [], $perPage = 10);
}
