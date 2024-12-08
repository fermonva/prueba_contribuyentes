<?php

namespace App\Repositories;

use App\Interfaces\ContribuyenteRepositoryInterface;
use App\Models\Contribuyente;

class ContribuyenteRepository extends BaseRepository implements ContribuyenteRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct( Contribuyente $model )
    {
        parent::__construct( $model );
    }
}
