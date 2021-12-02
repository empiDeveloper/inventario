<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        return Inventario::with(['bodega','producto'])->orderBy('created_by','ASC')->get();
    }

    public function store()
    {
        $guardar = Inventario::create([
            'producto_id' => request()->producto_id,
            'bodega_id' => request()->bodega_id,
            'cantidad' => request()->cantidad,
            'created_by' => NOW()
        ]);
        if (!$guardar) {
            return "false";
        }
        return Inventario::with(['bodega','producto'])->orderBy('created_by','ASC')->get();
    }
}
