<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Establecimiento;

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
        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();
        return response()->json($establecimientos);
    }
}
