@extends('layouts.app')

@section('title', 'Usuário X Grupo')

@section('style')
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>@yield('title')</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Início</a>
            </li>
            <li class="active">
                <strong>Lista</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-6">
        <div class="title-action">
            <a href="{{ route('grupo_usuario.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Acesso</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="grupo_usuarios_table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th>Grupo</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                @foreach($usuario->grupos as $grupo)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $grupo->nome }}</td>
                                    <td>
                                        <a href="{{ route('grupo_usuario.destroy', [$usuario->id, $grupo->id]) }}" class="text-danger"><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="/js/plugins/dataTables/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#grupo_usuarios_table').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {
                    extend: 'copy'
                },
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel',
                    title: 'ExampleFile'
                },
                {
                    extend: 'pdf',
                    title: 'ExampleFile'
                },

                {
                    extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });
    });
</script>
@endsection
