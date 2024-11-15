<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('rol.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all(); // Obtener todos los permisos disponibles
        return view('rol.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array', // Asegúrate de que sea un array
            'permissions.*' => 'exists:permissions,id', // Cada permiso debe existir en la tabla
        ]);

        // Crear el nuevo rol
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        // Sincronizar los permisos con el nuevo rol
        if ($request->has('permissions')) {
            // Obtener los nombres de los permisos seleccionados
            $permissions = Permission::whereIn('id', $request->input('permissions'))->pluck('name')->toArray();

            // Sincronizar los permisos por nombre
            $role->syncPermissions($permissions);
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id); // Buscar el rol por ID
        $permissions = Permission::all(); // Obtener todos los permisos disponibles
        return view('rol.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'array', // Asegúrate de que sea un array
            'permissions.*' => 'exists:permissions,id', // Cada permiso debe existir en la tabla
        ]);

        $role = Role::findOrFail($id); // Buscar el rol por ID
        $role->name = $request->input('name'); // Actualizar el nombre
        $role->save();

        // Obtener los nombres de los permisos seleccionados
        $permissions = Permission::whereIn('id', $request->input('permissions', []))->pluck('name')->toArray();

        // Sincronizar los permisos por nombre
        $role->syncPermissions($permissions); // Pasar nombres de permisos

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente');
    }
}
