<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use App\Models\Generale;
use App\Models\Tema;


use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos= Evento::orderBy('activo', 'desc')->get();
        return view('admin.eventos.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $general = Generale::first();
        return view('admin.eventos.create', compact('general'));
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
            'lugar' => 'required',
            'speach' => 'required',
            'direccion' => 'required',
            'ubicacion' =>'required',
            'precio' =>'required',
            'precio_prom' =>'required',
            'precio_seg' =>'required',
            'sobreventa' =>'required'
        ]);


        //return $request;

        if ($request->activo == 'on') {
            $act = 1;
        }
        else{
            $act=0;
        }


        if ($request->imagen) {
            $img = Storage::put('eventos', $request->file('imagen'));
        }
        else
        {
            $img = Generale::first()->value('imagen');
        }  

        Evento::create([
            'lugar' => $request->lugar,
            'speach' => $request->speach,
            'direccion' => $request->direccion,
            'ubicacion' => $request->ubicacion,
            'precio' => $request->precio,
            'precio_prom' => $request->precio_prom,
            'precio_seg' => $request->precio_seg,
            'sobreventa' => $request->sobreventa,
            'activo' =>$act,
            'imagen' => $img
        ]);

        

        return redirect()->route('admin.eventos.index')->with('info', 'El Evento se creó con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        $temas = Tema::pluck('titulo', 'id');
        return view('admin.eventos.show', compact('evento', 'temas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        $general = Generale::first();
        return  view('admin.eventos.edit', compact('evento', 'general'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'lugar' => 'required',
            'speach' => 'required',
            'direccion' => 'required',
            'ubicacion' =>'required',
            'precio' =>'required',
            'precio_prom' =>'required',
            'precio_seg' => 'required',
            'sobreventa' => 'required'
        ]);

        if ($request->activo == 'on') {
            $act = 1;
        }
        else{
            $act=0;
        }

        $evento->lugar = $request->lugar;
        $evento->speach = $request->speach;
        $evento->direccion = $request->direccion;
        $evento->ubicacion = $request->ubicacion;
        $evento->precio = $request->precio;
        $evento->precio_prom = $request->precio_prom;
        $evento->precio_seg = $request->precio_seg;
        $evento->sobreventa = $request->sobreventa;
        $evento->activo =$act;

        if ($request->imagen) {
            $img = Storage::put('eventos', $request->file('imagen'));
            $evento->imagen = $img;
        }

        $evento->save();
   
        return redirect()->route('admin.eventos.index')->with('info', 'El Evento se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('admin.eventos.index')->with('info', 'El Evento se eliminó con éxito');
    }


}
