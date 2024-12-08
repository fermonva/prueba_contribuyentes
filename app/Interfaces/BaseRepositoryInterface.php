<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * @return void
     */
    public function all() : iterable;

    public function find( int|string $id ) : ?Model;

    public function create( array $data ) : Model;

    public function update( Model $model, array $data ) : bool;

    public function delete( Model $model ) : bool;

    public function paginate( int $perPage = 10, array $filters = [] ) : LengthAwarePaginator;
}
