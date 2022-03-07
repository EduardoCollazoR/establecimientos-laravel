<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    //leer lasrutas por slug
    public function getRouteKeyName()
    {
        return  'slug';
    }

    //relacion 1 a n categorias establecimientos
    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class);
    }
}
