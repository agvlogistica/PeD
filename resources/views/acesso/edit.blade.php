@extends('layouts.app')

@section('title', 'Acesso')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>@yield('title')</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Início</a>
            </li>
            <li>
                <a href="{{ route('acesso.index' )}}">Lista</a>
            </li>
            <li class="active">
                <strong>Editar</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Cadastro de Acesso</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" action="{{ route('acesso.update', $acesso->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="empresa_id" class="col-md-2 control-label">Empresa</label>
                            <div class="col-md-10">
                                <select class="form-control" name="empresa_id">
                                    @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->id }}" @if($acesso->empresa->id === $empresa->id) {!! "selected" !!} @endif>{{ $empresa->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="menu_id" class="col-md-2 control-label">Menu</label>
                            <div class="col-md-10">
                                <select class="form-control" name="menu_id">
                                    @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}" @if($acesso->menu->id === $menu->id) {!! "selected" !!} @endif>{{ $menu->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_id" class="col-md-2 control-label">Usuário</label>
                            <div class="col-md-10">
                                <select class="form-control" name="user_id">
                                    <option value=""></option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if($acesso->user && $acesso->user->id === $user->id) {!! "selected" !!} @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="grupo_id" class="col-md-2 control-label">Grupo</label>
                            <div class="col-md-10">
                                <select class="form-control" name="grupo_id">
                                    <option value=""></option>
                                    @foreach($grupos as $grupo)
                                    <option value="{{ $grupo->id }}" @if($acesso->grupo && $acesso->grupo->id === $grupo->id) {!! "selected" !!} @endif>{{ $grupo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-10 col-md-2">
                                <button type="submit" name="gravar" class="btn btn-primary btn-block">Atulizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
