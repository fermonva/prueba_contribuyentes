<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribuyente extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_documento',
        'documento',
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'celular',
        'email',
        'usuario',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->nombres} {$this->apellidos}";
    }
}
