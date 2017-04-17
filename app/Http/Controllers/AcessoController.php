<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acessos = \App\Acesso::all();

        return view('acesso.index', compact('acessos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = \App\Empresa::all();
        $menus = \App\Menu::all();
        $users = \App\User::all();
        $grupos = \App\Grupo::all();

        return view('acesso.create', compact('empresas', 'menus', 'users', 'grupos'));
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
        $menu = \App\Menu::find($request->input('menu_id'));
        $user = \App\User::find($request->input('user_id'));
        $grupo = \App\Grupo::find($request->input('grupo_id'));

        $acesso = new \App\Acesso;

        $acesso->empresa()->associate($empresa);
        $acesso->menu()->associate($menu);
        $acesso->user()->associate($user);
        $acesso->grupo()->associate($grupo);

        $acesso->save();

        return redirect()->route('acesso.index');
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
        $acesso = \App\Acesso::find($id);

        $empresas = \App\Empresa::all();
        $menus = \App\Menu::all();
        $users = \App\User::all();
        $grupos = \App\Grupo::all();

        return view('acesso.edit', compact('acesso', 'empresas', 'menus', 'users', 'grupos'));
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
        $menu = \App\Menu::find($request->input('menu_id'));
        $user = \App\User::find($request->input('user_id'));
        $grupo = \App\Grupo::find($request->input('grupo_id'));

        $acesso = \App\Acesso::find($id);

        $acesso->empresa()->associate($empresa);
        $acesso->menu()->associate($menu);
        $acesso->user()->associate($user);
        $acesso->grupo()->associate($grupo);

        $acesso->save();

        return redirect()->route('acesso.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Acesso::destroy($id);

        return redirect()->route('acesso.index');
    }
}
