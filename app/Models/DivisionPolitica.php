<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionPolitica extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'admin_divisiones_politicas';

    /**
     * @var string
     */
    protected $primaryKey = 'dipo_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'dipo_id',
        'dipo_indicativo',
        'dipo_dep_id',
        'dipo_departamento',
        'dipo_ciudad',
        'dipo_activo',
    ];

    /**
     * Retorna el departamento - ciudad
     * @author Eminson Mendoza <emimaster16@gmail.com>
     * @since 09/07/2021
     * @return void
     */
    public function getDepartamentoCiudadAttribute()
    {
        return $this->dipo_departamento . ' - ' . $this->dipo_ciudad;
    }
}
