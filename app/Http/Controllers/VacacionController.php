<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacacionCreateRequest;
use App\Models\Vacacion;
use App\Models\Tipo;
use App\Models\Foto;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VacacionController extends Controller
{
    function __construct() {
        $this->middleware('verified')->except(['show', 'index', 'tipo']);
    }




    function create(): View|RedirectResponse {
        if(Auth::user()->rol != 'admin' && Auth::user()->rol != 'advanced') {
            return redirect()->route('home');
        }
        $tipos = Tipo::pluck('nombre', 'id');
        return view('vacacion.create', ['tipos' => $tipos]);
    }

    function destroy(Vacacion $vacacion): RedirectResponse {
        if(Auth::user()->rol != 'admin' && Auth::user()->rol != 'advanced') {
            return redirect()->route('home');
        }
        try {
            foreach($vacacion->fotos as $foto) {
                 if(Storage::disk('public')->exists($foto->ruta)) {
                    Storage::disk('public')->delete($foto->ruta);
                 }
            }
            
            $result = $vacacion->delete();
            $textMessage = 'La vacación se ha eliminado.';
        } catch(\Exception $e) {
            $textMessage = 'La vacación no se ha podido eliminar.';
            $result = false;
        }
        $message = [
            'mensajeTexto' => $textMessage,
        ];
        if($result) {
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    function edit(Vacacion $vacacion): View|RedirectResponse {
        if(Auth::user()->rol != 'admin' && Auth::user()->rol != 'advanced') {
            return redirect()->route('home');
        }
        $tipos = Tipo::pluck('nombre', 'id');
        return view('vacacion.edit', ['vacacion' => $vacacion, 'tipos' => $tipos]);
    }

    function index(): View {
        $vacaciones = Vacacion::all();
        return view('vacacion.index', ['vacaciones' => $vacaciones]);
    }

    function tipo(Tipo $tipo): View {
        return view('vacacion.tipo', [
            'hasPagination' => true,
            'vacaciones' => $tipo->vacaciones()->paginate(3),
            'tipo' => $tipo
        ]);
    }

    function show(Vacacion $vacacion): View {
        return view('vacacion.show', ['vacacion' => $vacacion]);
    }

    function store(VacacionCreateRequest $request): RedirectResponse {
        if(Auth::user()->rol != 'admin' && Auth::user()->rol != 'advanced') {
            return redirect()->route('home');
        }
        $vacacion = new Vacacion($request->all());
        $result = false;
        try {
            $result = $vacacion->save();
            $txtmessage = 'La vacación ha sido añadida.';
            
            if($request->hasFile('image')) {
                $ruta = $this->upload($request, $vacacion);
                $foto = new Foto();
                $foto->idvacacion = $vacacion->id;
                $foto->ruta = $ruta;
                $foto->save();
            }
            
        } catch(UniqueConstraintViolationException $e) {
            $txtmessage = 'Clave única.';
        } catch(QueryException $e) {
            $txtmessage = 'Campo null';
        } catch(\Exception $e) {
            $txtmessage = 'Error fatal';
        }
        $message = [
            'mensajeTexto' => $txtmessage,
        ];
        if($result) {
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    function update(Request $request, Vacacion $vacacion): RedirectResponse {
        if(Auth::user()->rol != 'admin' && Auth::user()->rol != 'advanced') {
            return redirect()->route('home');
        }
        $result = false;
        
        if($request->deleteImage == 'true') {
             foreach($vacacion->fotos as $foto) {
                 $foto->delete();
             }
        }

        $vacacion->fill($request->all());
        
        try {
            if($request->hasFile('image')) {
                $ruta = $this->upload($request, $vacacion);
                $foto = new Foto();
                $foto->idvacacion = $vacacion->id;
                $foto->ruta = $ruta;
                $foto->save();
            }
            $result = $vacacion->save();
            $txtmessage = 'La vacación ha sido editada.';
        } catch(UniqueConstraintViolationException $e) {
            $txtmessage = 'Clave única.';
        } catch(QueryException $e) {
            $txtmessage = 'Valor nulo.';
        } catch(\Exception $e) {
            $txtmessage = 'Error fatal.';
        }
        $message = [
            'mensajeTexto' => $txtmessage,
        ];
        if($result) {
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    private function upload(Request $request, Vacacion $vacacion): string {
        $image = $request->file('image');
        $name = $vacacion->id . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $ruta = $image->storeAs('vacacion', $name, 'public');
        $ruta = $image->storeAs('vacacion', $name, 'local');
        return $ruta;
    }

}