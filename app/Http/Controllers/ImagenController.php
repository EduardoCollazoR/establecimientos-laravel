<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //

    public function store(Request $request)
    {
        //leer la imagen
        $ruta_imagen = $request->file('file')->store('establecimientos', 'public');

        $imagen = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 450);
        $imagen->save();

        //almacenar con modelo
        $imagenDB = new Imagen();
        $imagenDB->id_establecimiento = $request['uuid'];
        $imagenDB->ruta_imagen = $ruta_imagen;
        $imagenDB->save();

        //retonar rspuestas
        $respuesta = [
            'archivo' => $ruta_imagen,
        ];
        return response()->json($respuesta);
    }
    //eliminar imagen
    public function destroy(Request $request)
    {
        $imagen = $request->get('imagen');


        if (File::exists('storage/' . $imagen)) {
            File::delete('storage/' . $imagen);
        }

        $respuesta = [
            'mensaje' => 'Imagen eliminada',
            'imagen' => $imagen
        ];

        Imagen::where('ruta_imagen', $imagen)->delete();
        //$imagenEliminar=Imagen::where('ruta_imagen', $imagen)->firtsOrFail();
        //Imagen::destory($imagenEliminar);
        return response()->json($respuesta);
    }
}
