@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
                <div class="p-3 flex items-center gap-4">
                @auth

                <!--Agregamos el componente de livewire-->
                <livewire:like-post :post="$post" />
                
                {{-- @if($post->checkLike(auth()->user()))
                    <form method="POST" action=" {{ route('posts.likes.destroy', $post) }}">
                    @method('DELETE')
                    @csrf
                        <div class="my-4">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="red" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                @else
                    <form method="POST" action=" {{ route('posts.likes.store', $post) }}"> 
                    @csrf
                        <div class="my-4">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="white" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                @endif --}}
                    {{-- <p class="font-bold"> 
                    @if($post->likes()->count() === 1)
                        {{$post->likes()->count()}} <span class="font-normal"> like </span>
                    @else
                        {{$post->likes()->count()}} <span class="font-normal"> likes</span>
                    @endif
                    </p> --}}
                @endauth
                </div>
            <div>
                <p class="font-bold"> {{$post->user->username}}</p>
                <p class="text-sm text-gray-500">
                    {{$post->created_at->diffForhumans()}}
                </p>
                <p class="my-5">
                    {{$post->descripcion}}
                </p>
            </div>
            <!--Boton de eliminar publicación-->
            @auth
                @if($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                    @method('DELETE')
                    @csrf
                    <!--Ha esto se le conoce como method spoofing-->
                    <input 
                        type="submit"
                        value="Eliminar publicación"
                        class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                    />
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="mb-5 bg-white p-5">
            @auth
                <p class="font-bold text-center text-xl">Agrega un comentario</p>
                @if(session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg text-center uppercase font-bold text-white mb-6">
                        {{session('mensaje')}}
                    </div>
                @endif
                <form action=" {{ route('comentarios.store', ['post'=> $post, 'user' => $user])}} " method="POST">
                @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                        Ingresa tu comentario
                        </label>
                        <textarea
                            id="comentario"
                            name="comentario"
                            placeholder="Comentario nuevo"
                            value=""
                            class="border p-3 w-full rounded-lg 
                            @error('comentario')
                                border-red-700
                            @enderror"></textarea>
                            @error('comentario')
                                <p class="bg-red-700 text-white p-3 text-center rounded-lg m-2">{{$message}}</p>
                            @enderror

                            <input
                                type="submit"
                                value="Comentar"
                                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white rounded-lg p-3"
                            />
                    </div>
                </form>
             @endauth

             <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll">
                @if($post->comentarios->count())
                    @foreach ($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('posts.index',$comentario->user)}}" class="font-bold text-gray-600">
                                {{$comentario->user->username}}
                            </a>
                            <p>{{$comentario->comentario}}</p>
                            <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                        </div>
                    @endforeach 
                @else
                    <p class="p-10 text-center">No hay comentarios aún</p>
                @endif
             </div>
            </div>

        </div>
    </div>
@endsection