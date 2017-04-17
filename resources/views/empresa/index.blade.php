@extends('layouts.app')

@section('title', 'Empresa')

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
            <a href="{{ route('empresa.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Cadastro</a>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Empresa</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="empresas_table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>CSS Template</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($empresas as $empresa)
                                <tr>
                                    <td>{{ $empresa->id }}</td>
                                    <td>{{ $empresa->nome }}</td>
                                    <td>{{ $empresa->css_template }}</td>
                                    <td>
                                        <a href="{{ route('empresa.edit', $empresa->id) }}" class="text-success"><i class="fa fa-pencil-square-o"></i> </a>|
                                        <a href="{{ route('empresa.destroy', $empresa->id) }}" class="text-danger"><i class="fa fa-trash"></i> </a>
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
        $('#empresas_table').DataTable({
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
