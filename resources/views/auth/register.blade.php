@extends('layouts.app')

@section('titulo')
    Registrate en DevStagram
@endsection

@section('contenido')

<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12 shadow-xl rounded p-5">
        <img src="{{ asset('img/registrar.jpg') }}">
    </div>

    <div class="md:w-4/12 bg-white p-5 rounded-lg shadow-xl">
        <form action="{{route('register.store')}}" method="POST" novalidate>
        @csrf
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                Nombre
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Tu nombre"
                    value="{{old('name')}}"
                    class="border p-3 w-full rounded-lg 
                    @error('name')
                        border-red-700
                    @enderror">
                    @error('name')
                        <p class="bg-red-700 text-white p-3 text-center rounded-lg m-2">{{$message}}</p>
                    @enderror
            </div>
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                Usuario
                </label>
                <input
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Tu nombre de usuario"
                    value="{{old('username')}}"
                    class="border p-3 w-full rounded-lg"
                    @error('username')
                        border-red-700
                    @enderror">
                    @error('username')
                        <p class="bg-red-700 text-white p-3 text-center rounded-lg m-2">{{$message}}</p>
                    @enderror
            </div>
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
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                Repetir Password
                </label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="Repatir password"
                    class="border p-3 w-full rounded-lg">
            </div>
            <input
                type="submit"
                value="Crear cuentas"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white rounded-lg"
            />
        </form>
    </div>

   
            
        

</div>

@endsection