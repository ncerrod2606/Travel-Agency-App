<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{

    function __construct() {
        $this->middleware(AdminMiddleware::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('user.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $rols = ['user', 'advanced', 'admin'];
        return view('user.create', ['rols' => $rols]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse {
        $result = false;
        $messageString = 'Error al crear el usuario.';
        $user = new User($request->all());
        $user->password = Hash::make($request->password);
        try {
            $result = $user->save();
            $messageString = 'Usuario creado correctamente.';
        } catch(\Exception $e) {
            $messageString = 'Error al crear el usuario: ' . $e->getMessage();
        }
        
        $message = ['mensajeTexto' => $messageString];
        
        if($result) {
            return redirect()->route('user.index')->with($message);
        } else {
             return back()->withInput()->withErrors($message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $rols = ['user', 'advanced', 'admin'];
        return view('user.edit', [
            'user' => $user,
            'rols' => $rols
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $result = false;
        $messageString = 'Error al actualizar el usuario.';
        $data = $request->all();
        if(!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        
        $user->fill($data);
        
        try {
            $result = $user->save();
             $messageString = 'Usuario actualizado correctamente.';
        } catch(\Exception $e) {
            $messageString = 'Error al actualizar el usuario.';
        }
        
        $message = ['mensajeTexto' => $messageString];
        if($result) {
            return redirect()->route('user.index')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $result = false;
        $messageString = 'Error al eliminar el usuario.';
        try {
            $result = $user->delete();
            $messageString = 'Usuario eliminado correctamente.';
        } catch(\Exception $e) {
            $messageString = 'Error al eliminar el usuario.';
        }
        $message = ['mensajeTexto' => $messageString];
        
        if($result) {
            return redirect()->route('user.index')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }
}
