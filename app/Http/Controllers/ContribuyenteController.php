<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContribuyenteRequest;
use App\Interfaces\ContribuyenteRepositoryInterface;
use App\Models\Contribuyente;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContribuyenteController extends Controller
{
    protected ContribuyenteRepositoryInterface $contribuyenteRepositoryInterface;

    public function __construct(ContribuyenteRepositoryInterface $contribuyenteRepositoryInterface)
    {
        $this->authorizeResource(User::class);
        $this->contribuyenteRepositoryInterface = $contribuyenteRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Renderable
    {
        $filters = [
            'tipo_documento' => $request->get('tipo_documento'),
            'documento' => $request->get('documento'),
            'nombres' => $request->get('nombres'),
            'apellidos' => $request->get('apellidos'),
            'telefono' => $request->get('telefono'),
        ];

        $contribuyentes = $this->contribuyenteRepositoryInterface->paginateAll($filters);
        return view('contribuyente.index', compact('contribuyentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Renderable
    {
        return view('contribuyente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContribuyenteRequest $request): RedirectResponse
    {
        try {
            // Valida y guarda el nuevo contribuyente
            $this->contribuyenteRepositoryInterface->create($request->validated());
            return redirect()->route('contribuyentes.index')->with('success', 'Contribuyente creado con éxito.');
        } catch (\Exception $e) {
            // Redirige de vuelta con mensaje de error
            return redirect()->back()->withErrors(['error' => 'Error al guardar el contribuyente: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Renderable
    {
        $contribuyente = $this->contribuyenteRepositoryInterface->find($id);
        return view('contribuyente.show', compact('contribuyente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Renderable
    {
        $contribuyente = $this->contribuyenteRepositoryInterface->find($id);
        return view('contribuyente.edit', compact('contribuyente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContribuyenteRequest $request, Contribuyente $contribuyente): RedirectResponse
    {
        try {
            // Valida y edita el contribuyente
            $this->contribuyenteRepositoryInterface->update($contribuyente, $request->validated());
            return redirect()->route('contribuyentes.index');
        }catch (\Exception $e) {
            // Redirige de vuelta con mensaje de error
            return redirect()->back()->withErrors(['error' => 'Error al guardar el contribuyente: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->contribuyenteRepositoryInterface->delete($id);
        return redirect()->route('contribuyentes.index');
    }
}
