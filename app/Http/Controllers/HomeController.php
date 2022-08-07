<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke()
    {
        /**Es necesario consultar a quienes seguimos para saber que publicaciones mostrar
         * para eso usamos el metodo de followings que nos dice a quiense estamos siguiendo.
         */

        $ids = auth()->user()->followings->pluck('id')->toArray();

        $posts = Post::wherein('user_id', $ids)->latest()->paginate(20);
        //dd($posts);

         return view('Home')->with('posts', $posts);
    }
}
