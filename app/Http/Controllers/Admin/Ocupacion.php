<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Evento;

class Ocupacion extends Controller
{
    public function index()
    {
        return view('admin.ocupacion.index');
    }
}
