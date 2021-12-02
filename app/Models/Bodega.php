<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bodega extends Model
{
    use HasFactory;

    // protected $with = [
    //     'responsable'
    // ];

    protected $fillable = [
        'nombre',
        'user_id',
        'estado',
    ];

    public function responsable()
    {
        return $this->hasOne(User::class, 'id')->select(array('id','name'));
    }

    public function scopeEstado($query)
    {
        return $query->where('estado',1);
    }
}
