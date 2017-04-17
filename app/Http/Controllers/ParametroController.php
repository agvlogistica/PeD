<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ParametroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parametros = \App\Parametro::all();

        return view('parametro.index', compact('parametros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = \App\Empresa::all();
        $users = \App\User::all();
        $grupos = \App\Grupo::all();

        return view('parametro.create', compact('empresas', 'users', 'grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresa = \App\Empresa::find($request->input('empresa_id'));
        $user = \App\User::find($request->input('user_id'));
        $grupo = \App\Grupo::find($request->input('grupo_id'));

        $parametro = new \App\Parametro;

        $parametro->empresa()->associate($empresa);
        $parametro->controle = $request->input('controle');
        $parametro->tipo = $request->input('tipo');
        if ($request->input('item')) $parametro->item = $request->input('item');
        $parametro->user()->associate($user);
        $parametro->grupo()->associate($grupo);
        $parametro->parametro = $request->input('parametro');
        $parametro->ativo = $request->input('ativo') ? true : false;

        $parametro->save();

        return redirect()->route('parametro.index');
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
        $parametro = \App\Parametro::find($id);

        $empresas = \App\Empresa::all();
        $users = \App\User::all();
        $grupos = \App\Grupo::all();

        return view('parametro.edit', compact('parametro', 'empresas', 'users', 'grupos'));
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
        $empresa = \App\Empresa::find($request->input('empresa_id'));
        $user = \App\User::find($request->input('user_id'));
        $grupo = \App\Grupo::find($request->input('grupo_id'));

        $parametro = \App\Parametro::find($id);

        $parametro->empresa()->associate($empresa);
        $parametro->controle = $request->input('controle');
        $parametro->tipo = $request->input('tipo');
        if ($request->input('item')) $parametro->item = $request->input('item');
        $parametro->user()->associate($user);
        $parametro->grupo()->associate($grupo);
        $parametro->parametro = $request->input('parametro');
        $parametro->ativo = $request->input('ativo') ? true : false;

        $parametro->save();

        return redirect()->route('parametro.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Parametro::destroy($id);

        return redirect()->route('parametro.index');
    }
}
