<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventario extends Model
{
    use HasFactory;

    // protected $with = [
    //     'producto',
    //     'bodega'
    // ];

    protected $fillable = [
        'producto_id',
        'bodega_id',
        'cantidad',
        'created_by'
    ];

    public function bodega()
    {
        return $this->hasOne(Bodega::class,'id','bodega_id')->select(array('id','nombre'));
    }

    public function producto()
    {
        return $this->hasOne(Producto::class,'id','producto_id')->select(array('id','nombre'));
    }
}
