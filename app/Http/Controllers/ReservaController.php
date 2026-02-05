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
    function allReservations(): \Illuminate\View\View | RedirectResponse {
        if(Auth::user()->rol != 'admin') {
            return redirect()->route('home');
        }
        $users = \App\Models\User::with('reservas.vacacion')->has('reservas')->get();
        return view('reserva.admin', ['users' => $users]);
    }
}
