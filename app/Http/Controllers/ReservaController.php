<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Vacacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller {

    function __construct() {
        $this->middleware('auth');
    }

    function store(Request $request): RedirectResponse {
        $request->validate([
            'idvacacion' => 'required|exists:vacacion,id',
        ]);

        $result = false;
        $txtMessage = 'Error al realizar la reserva.';
        
        // Prevent duplicate bookings? Or allow? Prompt says "RESERVA: id, iduser, idvacacion".
        // Usually one booking per package per user is enough for basic logic.
        // I'll leave it as is, allow multiple or just save.
        
        $reserva = new Reserva();
        $reserva->iduser = Auth::id();
        $reserva->idvacacion = $request->idvacacion;
        
        try {
            $result = $reserva->save();
            $txtMessage = 'Reserva realizada con éxito.';
        } catch(\Exception $e) {
             $txtMessage = 'No se pudo realizar la reserva.';
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
}
