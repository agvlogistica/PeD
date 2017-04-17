@extends('layouts.app')

@section('title', 'Parametro')

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
            <a href="{{ route('parametro.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Cadastro</a>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Parametro</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="parametros_table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Empresa</th>
                                    <th>Controle</th>
                                    <th>Tipo</th>
                                    <th>Item</th>
                                    <th>Usuário</th>
                                    <th>Grupo</th>
                                    <th>Parâmetro</th>
                                    <th>Ativo</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parametros as $parametro)
                                <tr>
                                    <td>{{ $parametro->id }}</td>
                                    <td>
                                        @if($parametro->empresa)
                                        {{ $parametro->empresa->nome }}
                                        @endif
                                    </td>
                                    <td>{{ $parametro->controle }}</td>
                                    <td>{{ $parametro->tipo }}</td>
                                    <td>{{ $parametro->item }}</td>
                                    <td>
                                        @if($parametro->user)
                                        {{ $parametro->user->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($parametro->grupo)
                                        {{ $parametro->grupo->nome }}
                                        @endif
                                    </td>
                                    <td>{{ $parametro->parametro }}</td>
                                    <td>{{ $parametro->ativo }}</td>
                                    <td>
                                        <a href="{{ route('parametro.edit', $parametro->id) }}" class="text-success"><i class="fa fa-pencil-square-o"></i> </a>|
                                        <a href="{{ route('parametro.destroy', $parametro->id) }}" class="text-danger"><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
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
        $('#parametros_table').DataTable({
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
