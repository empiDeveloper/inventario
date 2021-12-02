<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bodega;
use App\Models\Producto;
use App\Models\Inventario;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {
        return [
            'usuarios' => User::all(),
            'bodegas' => Bodega::with('responsable')->estado()->get(),
            'inventario' => Inventario::with(['bodega','producto'])->orderBy('created_by','ASC')->get(),
            'productos' => Producto::estado()->get()
        ];
    }
}
