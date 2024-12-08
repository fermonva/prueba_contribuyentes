<?php

use App\Exceptions\ModelNotFoundException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Request;

return function (Exceptions $exceptions) {
    $exceptions->render(function (ModelNotFoundException $exception, Request $request) {
        return redirect()->back()->withErrors([
            'error' => 'El recurso solicitado no fue encontrado.'
        ]);
    });
};
