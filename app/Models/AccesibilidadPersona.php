<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccesibilidadPersona extends Model
{
    use HasFactory;

    protected $table = 'admin_accesibilidad_personas';

    /**
     * @var string
     */
    protected $primaryKey = 'acpe_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'acpe_id',
        'acpe_direccion',
        'dipo_municipio',
        'dipo_departamento',
        'dipo_id',
        'acpe_direccion_valida',
        'acpe_fecha_modificacion',
        'acpe_estado',
        'tiid_id',
        'prin_cedula',
        'prin_nombre_cp',
        'prin_celular',
        'prin_email',
        'usua_cedula',
        'acpe_fecha_sistema'
    ];

    public function divisionPolitica()
    {
        return $this->belongsTo(DivisionPolitica::class, 'dipo_id');
    }
}
