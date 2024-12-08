<?php

namespace App\Http\Controllers;

use App\Exceptions\ModelNotFoundException;
use App\Helpers\ExtractSearchFilters;
use App\Helpers\LetterCounterHelper;
use App\Http\Requests\ContribuyenteRequest;
use App\Interfaces\ContribuyenteRepositoryInterface;
use App\Models\Contribuyente;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContribuyenteController extends Controller
{
    protected ContribuyenteRepositoryInterface $contribuyenteRepositoryInterface;

    public function __construct( ContribuyenteRepositoryInterface $contribuyenteRepositoryInterface )
    {
        $this->contribuyenteRepositoryInterface = $contribuyenteRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index( Request $request ) : Renderable
    {
        $filters        = ExtractSearchFilters::extractFiltersContribuyente( $request );
        $contribuyentes = $this->contribuyenteRepositoryInterface->paginate( 10, $filters );

        return view( 'contribuyente.index', compact( 'contribuyentes' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : Renderable
    {
        return view( 'contribuyente.create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( ContribuyenteRequest $request ) : RedirectResponse
    {
        $this->contribuyenteRepositoryInterface->create( $request->validated() );

        return redirect()->route( 'contribuyentes.index' )->with( 'success', 'Contribuyente creado con éxito.' );
    }

    /**
     * Display the specified resource.
     */
    public function show( string $id ) : Renderable | RedirectResponse
    {
        try {
            $this->authorize( 'ver contribuyentes' );
            $contribuyente = $this->contribuyenteRepositoryInterface->find( $id );

            $letterCounts = LetterCounterHelper::countLetters( $contribuyente->full_name );

            return view( 'contribuyente.show', compact( 'contribuyente', 'letterCounts' ) );
        } catch ( ModelNotFoundException $e ) {
            return redirect()->route( 'contribuyentes.index' )->withErrors( ['error' => $e->getMessage()] );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( string $id ) : Renderable
    {
        $this->authorize( 'editar contribuyentes' );
        $contribuyente = $this->contribuyenteRepositoryInterface->find( $id );

        return view( 'contribuyente.edit', compact( 'contribuyente' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( ContribuyenteRequest $request, Contribuyente $contribuyente ) : RedirectResponse
    {
        $this->contribuyenteRepositoryInterface->update( $contribuyente, $request->validated() );

        return redirect()->route( 'contribuyentes.index' )->with( 'success', 'Contribuyente actualizado con éxito.' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id ) : RedirectResponse
    {
        $contribuyente = $this->contribuyenteRepositoryInterface->find( $id );
        $this->contribuyenteRepositoryInterface->delete( $contribuyente );

        return redirect()->route( 'contribuyentes.index' )->with( 'success', 'Contribuyente eliminado con éxito.' );
    }
}
