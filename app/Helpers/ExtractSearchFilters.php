<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class ExtractSearchFilters
{
    public static function extractFiltersContribuyente(Request $request): array
    {
        return $request->only(['tipo_documento', 'documento', 'nombres', 'apellidos', 'telefono']);
    }
}
