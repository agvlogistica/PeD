@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>@yield('title')</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Início</a>
            </li>
            <li class="active">
                <strong>@yield('title')</strong>
            </li>
        </ol>
    </div>
</div>
<div class="row animated fadeIn">
    <div class="col-md-10 col-md-offset-1">
        <div class="wrapper wrapper-content">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Dados</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" action="{{ route('user.update', $user->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-2 control-label">E-mail:</label>
                            <div class="col-md-10">
                                <p class="form-control-static">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">Nome:</label>
                            <div class="col-md-10">
                                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-md-2 pull-right">
                                <button type="submit" name="update" class="btn btn-primary pull-right col-md">Gravar Alterações</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
