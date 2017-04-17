@extends('layouts.app')

@section('title', 'Parametro')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>@yield('title')</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Início</a>
            </li>
            <li>
                <a href="{{ route('parametro.index' )}}">Lista</a>
            </li>
            <li class="active">
                <strong>Cadastro</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Cadastro de Parametro</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" action="{{ route('parametro.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="empresa_id" class="col-md-2 control-label">Empresa</label>
                            <div class="col-md-10">
                                <select class="form-control" name="empresa_id">
                                    <option value="">Selecione ...</option>
                                    @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="controle" class="col-md-2 control-label">Controle</label>
                            <div class="col-md-10">
                                <input type="text" name="controle" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipo" class="col-md-2 control-label">Tipo</label>
                            <div class="col-md-10">
                                <input type="text" name="tipo" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="item" class="col-md-2 control-label">Item</label>
                            <div class="col-md-10">
                                <input type="number" name="item" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_id" class="col-md-2 control-label">Usuário</label>
                            <div class="col-md-10">
                                <select class="form-control" name="user_id">
                                    <option value="">Selecione ...</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="grupo_id" class="col-md-2 control-label">Grupo</label>
                            <div class="col-md-10">
                                <select class="form-control" name="grupo_id">
                                    <option value="">Selecione ...</option>
                                    @foreach($grupos as $grupo)
                                    <option value="{{ $grupo->id }}">{{ $grupo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="parametro" class="col-md-2 control-label">Parâmetro</label>
                            <div class="col-md-10">
                                <input type="text" name="parametro" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ativo" class="col-md-2 control-label">Ativo</label>
                            <div class="col-md-10">
                                <input type="checkbox" name="ativo" value="1" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-10 col-md-2">
                                <button type="submit" name="gravar" class="btn btn-primary btn-block">Gravar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
