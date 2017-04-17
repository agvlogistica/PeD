<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Grupo_usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = \App\User::all();

        return view('grupo_usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = \App\User::all();
        $grupos = \App\Grupo::all();

        return view('grupo_usuario.create', compact('users', 'grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \App\User::find($request->input('user_id'))->grupos()->attach($request->input('grupo_id'));

        return redirect()->route('grupo_usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $grupo_id)
    {
        \App\User::find($user_id)->grupos()->detach($grupo_id);

        return redirect()->route('grupo_usuario.index');
    }
}
