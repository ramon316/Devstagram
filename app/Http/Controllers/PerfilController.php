<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('perfil.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       //dd('Guardando cambios');
       $this->validate($request,[
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20','not_in:Twitter,Facebook,editar-perfil'],
       ]);
       /**Validamos si existe imagen par apoder guardar */
       if ($request->imagen) {
            //con esto ya tenemos a nuestra imagen
            $imagen = $request->file('imagen');
            //Ahora le damos un nombr eunico a nuestra imagen, con uuid garantizamos el nombre unioco
            $nombreImagen = Str::uuid().".".$imagen->extension();
            //utilizamos intervention image, ya lo guardaremos 
            $imagenServidor = Image::make($imagen);
            /**Como ya tenemos nuestra imagen ahora si le podemos dar formato 
             * pixeles y tamaño de 1000x1000
            */
            $imagenServidor->fit(1000,1000);
            /**Mover la imagen al servidor */
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            /**Guardamos en servidor la ruta y nombre de la imagen  */
            $imagenServidor->save($imagenPath);
        }
        /**Creamos el nombre del usuarios */
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        /**Esto quiere decir que si no existe el nombrede la imagen lo pone como null
         * Quiere decir que si dejamos la imagen vacia lo que hara es que dejara el campo vacio
         * ahora con los multiples signos les damos las multiples opciones
         * por ejemplo si no tiene imagen, verifica si ya tiene una imagen el usuario y la vuelve a guardar
         * si no, lo deja vacio
         */
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();
    
        /**Redireccionar, no podemos usar el auth por que puede haber sido modificado*/
        return redirect()->route('posts.index',$usuario->username);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
