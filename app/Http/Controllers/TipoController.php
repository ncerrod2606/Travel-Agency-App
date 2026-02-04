<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TipoController extends Controller {

    function create(): View {
        return view('tipo.create'); // Placeholder if needed
    }

    function destroy(Tipo $tipo): RedirectResponse {
        return redirect()->route('main');
    }

    function edit(Tipo $tipo): View {
        return view('tipo.edit', ['tipo' => $tipo]);
    }

    function index(): View {
         return view('tipo.index');
    }

    function show(Tipo $tipo): View {
         return view('tipo.show', ['tipo' => $tipo]);
    }

    function store(Request $request): RedirectResponse {
         return redirect()->route('main');
    }

    function update(Request $request, Tipo $tipo): RedirectResponse {
         return redirect()->route('main');
    }
}