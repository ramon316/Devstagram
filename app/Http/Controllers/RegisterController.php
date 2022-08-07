<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        //dd($request);
        /**validación */

        $this->validate($request,
        [
            'name'  => 'required|max:40',
            'username'  =>'required|unique:users|min:3|max:20',
            'email'     =>'required|email|unique:users',
            'password'  =>'required|confirmed|min:6',
        ]);

        User::create([
            'name'      =>  $request->name,
            'username'  =>  Str::slug($request->username),
            'email'     =>  $request->email,
            'password'  =>  Hash::make($request->password),
        ]);
        // /**Autenticación del usuario */
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);
        /**Otra manera de autenticación */
        auth()->attempt($request->only('email','password'));

        return redirect()->route('post.index',$request->username);

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
