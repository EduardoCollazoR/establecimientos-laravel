<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class APIController extends Controller
{
    //metodo para obtener todas las categorias

    public function categorias()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    //muestra los establecimientos de la categoria en especifico
    public function categoria(Categoria $categoria)
    {
    }
}
