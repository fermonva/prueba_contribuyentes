<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccesibilidadPersona;
use App\Models\DivisionPolitica;
use Illuminate\Http\Request;

class AccesibilidadPersonaController extends Controller
{
    public function index(Request $request)
    {
        return view('accesibilidad_personas.index', [
            'personas' => $this->registros($request),
        ]);
    }

    protected function registros(Request $request, $paginacion = true)
    {

        $fieldsSearch = ['tiid_id', 'prin_cedula', 'prin_nombre_cp', 'prin_email', 'prin_celular', 'dipo_municipio'];

        $query = AccesibilidadPersona::query()
            ->select('admin_accesibilidad_personas.*');

        $hasSearch = collect($fieldsSearch)->some(fn($field) => $request->filled($field));

        if ($hasSearch) {
            foreach ($fieldsSearch as $field) {
                if ($request->filled($field)) {
                    $query->where("admin_accesibilidad_personas.$field", 'LIKE', '%' . $request->$field . '%')->orderByDesc("admin_accesibilidad_personas.$field")
                        ->orderBy('admin_accesibilidad_personas.acpe_estado', 'ASC');
                }
            }
        } else {
            $query->orderByDesc('admin_accesibilidad_personas.acpe_fecha_modificacion')
                ->orderBy('admin_accesibilidad_personas.acpe_estado', 'ASC');
        }

        return $paginacion
            ? $query->paginate(5)->withPath(route('accesibilidad_personas.index'))
            : $query->get();
    }

    public function create()
    {
        $departamentos = $this->getDepartamentos();
        return view('accesibilidad_personas.create', compact('departamentos'));
    }

    protected function getDepartamentos()
    {
        return DivisionPolitica::orderBy('dipo_departamento')->pluck('dipo_departamento', 'dipo_dep_id');
    }

    protected function getMunicipios($dipo_dep_id)
    {
        $municipios = DivisionPolitica::where('dipo_dep_id', $dipo_dep_id)->get()->pluck('dipo_ciudad', 'dipo_id');

        return response()->json(['municipios' => $municipios]);
    }
}
