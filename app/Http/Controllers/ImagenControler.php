<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenControler extends Controller
{
    //
    public function store(Request $request){
        //con esto ya tenemos a nuestra imagen
        $imagen = $request->file('file');
        //Ahora le damos un nombr eunico a nuestra imagen, con uuid garantizamos el nombre unioco
        $nombreImagen = Str::uuid().".".$imagen->extension();
        //utilizamos intervention image, ya lo guardaremos 
        $imagenServidor = Image::make($imagen);
        /**Como ya tenemos nuestra imagen ahora si le podemos dar formato 
         * pixeles y tamaño de 1000x1000
        */
        $imagenServidor->fit(1000,1000);
        /**Mover la imagen al servidor */
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        /**Guardamos en servidor la ruta y nombre de la imagen  */
        $imagenServidor->save($imagenPath);
        return response()->json(['imagen'=> $nombreImagen]);
    }
}
