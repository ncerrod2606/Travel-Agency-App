<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Reserva;
use App\Models\Vacacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ComentarioController extends Controller {

    function __construct() {
        $this->middleware('auth');
    }

    function edit(Request $request, Comentario $comentario): View|RedirectResponse {
        if(Auth::id() == $comentario->iduser || Auth::user()->rol == 'admin') {
            return view('comentario.edit', ['comentario' => $comentario]);
        } else {
            return redirect()->route('home');
        }
    }

    function store(Request $request): RedirectResponse {
        $request->validate([
            'texto' => 'required|string|min:10',
            'idvacacion' => 'required|exists:vacacion,id',
        ]);

        $result = false;
        $txtMessage = 'No se ha podido agregar el comentario';
        
        // Validation: User must have reserved the vacation
        $hasReserved = Reserva::where('iduser', Auth::id())
                              ->where('idvacacion', $request->idvacacion)
                              ->exists();
                              
        if(!$hasReserved) {
            return back()->withInput()->withErrors(['mensajeTexto' => 'Solo los usuarios que han reservado pueden comentar.']);
        }

        $comentario = new Comentario($request->all());
        $comentario->iduser = Auth::id(); // Assign current user
        
        try {
            $result = $comentario->save();
            $txtMessage = 'Comentario agregado correctamente';
        } catch(\Exception $e) {
            $txtMessage = 'Error al guardar el comentario.';
        }
        $message = [
            'mensajeTexto' => $txtMessage,
        ];
        if($result) {
            return back()->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    function update(Request $request, Comentario $comentario): RedirectResponse {
        if(Auth::id() == $comentario->iduser || Auth::user()->rol == 'admin'){
            $request->validate([
                'texto' => 'required|string|min:10',
            ]);
            $result = false;
            $comentario->fill($request->all());
            try {
                $result = $comentario->save();
                $txtmessage = 'Comentario modificado.';
            } catch(\Exception $e) {
                $txtmessage = 'Error al modificar.';
            }
            $message = [
                'mensajeTexto' => $txtmessage,
            ];
            if($result) {
                // Return to vacation details
                return redirect()->route('vacacion.show', $comentario->idvacacion)->with($message);
            } else {
                return back()->withInput()->withErrors($message);
            }
        } else {
            return redirect()->route('home');
        }
    }

    function destroy(Comentario $comentario): RedirectResponse {
        if(Auth::id() == $comentario->iduser || Auth::user()->rol == 'admin') {
            try {
                $comentario->delete();
                $message = ['mensajeTexto' => 'Comentario eliminado.'];
            } catch(\Exception $e) {
                $message = ['mensajeTexto' => 'Error al eliminar comentario.'];
            }
            return back()->with($message);
        } else {
            return redirect()->route('home');
        }
    }
}