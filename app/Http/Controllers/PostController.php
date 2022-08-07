<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        /**
         * Vamos a consultar las publicaciones del usuario
         */
        $posts = Post::where('user_id',$user->id)->paginate(10);
        //d($posts);

        return view('dashboard',[
            'user'=> $user,
            'posts'=>$posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Guardamos la información en la base de sdatos 
       $this->validate($request,[
            'titulo'    => 'required|max:255',
            'descripcion'   =>  'required',
            'imagen'        =>  'required',
       ]);
       
       Post::create([
        'titulo' => $request->titulo,
        'descripcion'   => $request->descripcion,
        'imagen'    => $request->imagen,
        'user_id'   => auth()->user()->id,
       ]);


       return redirect()->route('posts.index', auth()->user()->username);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user'  => $user,
        ]);
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
    public function destroy(Post $post)
    {
        //vamos a utilizar nuestro policy
        /**De es amanera usamos el policy y el metodo delete para que tome el post y lo compare que nos regrese un valor, true or false */
        $this->authorize('delete', $post);
        $post->delete();

        /**Eliminar tambien la imagen por que se queda guardada. Arriba se elimino solo el registro */
        $imagen_path = public_path('uploads/' . $post->imagen);
        if (File::exists($imagen_path)) {
            /**Usaremos una funcion de php */
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
