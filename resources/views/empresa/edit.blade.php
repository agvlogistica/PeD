@extends('layouts.app')

@section('title', 'Empresa')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>@yield('title')</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Início</a>
            </li>
            <li>
                <a href="{{ route('empresa.index' )}}">Lista</a>
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
                    <h5>Cadastro de Empresa</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" action="{{ route('empresa.update', $empresa->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nome" class="col-md-2 control-label">Nome</label>
                            <div class="col-md-10">
                                <input type="text" name="nome" value="{{ $empresa->nome }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="css_template" class="col-md-2 control-label">CSS Template</label>
                            <div class="col-md-10">
                                <input type="text" id="css_template" name="css_template" value="{{ $empresa->css_template }}" class="form-control">
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
