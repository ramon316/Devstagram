@extends('layouts.app')

@section('titulo')
    Inicia sesion en DevStagram
@endsection

@section('contenido')

<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12 shadow-xl rounded p-5">
        <img src="{{ asset('img/login.jpg') }}">
    </div>

    <div class="md:w-4/12 bg-white p-5 rounded-lg shadow-xl">
        <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        @if(session('mensaje'))
            <p class="bg-red-700 text-white p-3 text-center rounded-lg m-2">
                {{ session('mensaje') }}
            </p>
        @endif
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                Email
                </label>
                <input
                    id="email"
                    name="email"
                    type="text"
                    placeholder="Ingresa tu correo electrónico"
                    value="{{old('email')}}"
                    class="border p-3 w-full rounded-lg"
                    @error('email')
                        border-red-700
                    @enderror">
                    @error('email')
                        <p class="bg-red-700 text-white p-3 text-center rounded-lg m-2">{{$message}}</p>
                    @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                Password
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Password de registros"
                    value="{{old('password')}}"
                    class="border p-3 w-full rounded-lg"
                    @error('password')
                        border-red-700
                    @enderror">
                    @error('password')
                        <p class="bg-red-700 text-white p-3 text-center rounded-lg m-2">{{$message}}</p>
                    @enderror
            </div>
            <div class="mb-5">
                <input type="checkbox" name="remember"><label clas="text-gray-500 text-sm">Mantener mi sesion abierta</label>
            </div>
            <input
                type="submit"
                value="Iniciar Sesion"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white rounded-lg"
            />
        </form>
    </div>

   
            
        

</div>

@endsection