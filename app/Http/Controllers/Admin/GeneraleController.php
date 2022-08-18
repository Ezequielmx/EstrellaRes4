<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generale;

use Illuminate\Support\Facades\Storage;

class GeneraleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generale = Generale::first();
        //return route('admin.generales.edit', $generale);
        return view('admin.generales.edit',compact('generale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.generales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Generale $generale)
    {
        return view('admin.generales.show',compact('generale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Generale $generale)
    {
        return view('admin.generales.edit', compact('generale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Generale $generale)
    {
        $request->validate([
            'speach' => 'required',
            'minutos' => 'required',
            'precio' => 'required',
            'precio_prom' => 'required',
            'precio_seg' => 'required',
            'sobreventa' => 'required'
        ]);

        
        if ($request->imagen) {
            $img = Storage::put('generales', $request->file('imagen'));
            $generale->imagen = $img;
        }
        
        $generale->speach = $request->speach;
        $generale->minutos = $request->minutos;
        $generale->precio = $request->precio;
        $generale->precio_prom = $request->precio_prom;
        $generale->precio_seg = $request->precio_seg;
        $generale->sobreventa = $request->sobreventa;
        
        $generale->save();

        return redirect()->route('admin.generales.index')->with('info', 'Cambios guardados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Generale $Generale)
    {
        //
    }
}
