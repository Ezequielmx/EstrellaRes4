<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' =>'required',
            'pass' =>'required|min:8'
        ]);

        $passhash = Hash::make($request->pass);

        User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => $passhash 
        ]);

        return redirect()->route('admin.usuarios.index')->with('info', 'Usuario agregado con éxito');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(User $usuario)
    {
       $usuario->delete();
       return redirect()->route('admin.usuarios.index')->with('info', 'Usuario eliminado con éxito');
    }
}
