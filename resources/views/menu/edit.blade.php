@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>@yield('title')</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Início</a>
            </li>
            <li>
                <a href="{{ route('menu.index' )}}">Lista</a>
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
                    <h5>Cadastro de Menu</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" action="{{ route('menu.update', $menu->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="ordem" class="col-md-2 control-label">Ordem</label>
                            <div class="col-md-10">
                                <input type="number" name="ordem" value="{{ $menu->ordem }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nome" class="col-md-2 control-label">Nome</label>
                            <div class="col-md-10">
                                <input type="text" name="nome" value="{{ $menu->nome }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rota" class="col-md-2 control-label">Rota</label>
                            <div class="col-md-10">
                                <input type="text" name="rota" value="{{ $menu->rota }}" class="form-control">
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
