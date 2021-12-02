<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    public function index()
    {
        return Bodega::with('responsable')->estado()->get();
    }

    public function store()
    {
        $guardar = Bodega::create([
            'nombre' => request()->nombre,
            'user_id' => request()->user_id,
            'estado' => 1
        ]);
        if (!$guardar) {
            return "false";
        }
        return Bodega::with('responsable')->estado()->get();
    }
}
