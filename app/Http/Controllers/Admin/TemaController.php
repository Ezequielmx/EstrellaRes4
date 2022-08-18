<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Generale;
use Illuminate\Http\Request;
use App\Models\Tema;

use Illuminate\Support\Facades\Storage;

class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temas = Tema::all();
        return view('admin.temas.index', compact('temas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $duracion = Generale::first()->value('minutos');
        return view('admin.temas.create', compact('duracion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'duracion' => 'required',
            'imagen' =>'required'
        ]);

        $img = Storage::put('temas', $request->file('imagen'));

        
        $tema = Tema::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'duracion' => $request->duracion,
            'imagen' => $img
        ]);

        return redirect()->route('admin.temas.index')->with('info', 'El tema se creó con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  Tema $tema
     * @return \Illuminate\Http\Response
     */
    public function show(Tema $tema)
    {
        return view('admin.temas.show', compact('tema'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tema $tema
     * @return \Illuminate\Http\Response
     */
    public function edit(Tema $tema)
    {
        return view('admin.temas.edit', compact('tema'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Tema $tema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tema $tema)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'duracion' => 'required'
        ]);


        if ($request->imagen) {
            $img = Storage::put('temas', $request->file('imagen'));
            $tema->imagen = $img;
        }
        
        $tema->titulo = $request->titulo;
        $tema->descripcion = $request->descripcion;
        $tema->duracion = $request->duracion;
        
        $tema->save();

        return redirect()->route('admin.temas.index')->with('info', 'El tema se actualizó con éxito');
    }


    
    public function destroy(Tema $tema)
    {
        $tema->delete();

        return redirect()->route('admin.temas.index')->with('info', 'El tema se eliminó con éxito');
    }
}
