@extends('layouts.app')

@section('title', 'Pedidos para Integração')

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
                <strong>Listagem</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-6">
        <div class="title-action">
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <form class="form-horizontal" action="{{ route('ordermaker.geraXml')}}" method="get">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Lista de Pedidos para Integração</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table id="acessos_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nr Pedido</th>
                                        <th>Data</th>
                                        <th>Representante</th>
                                        <th>Cliente</th>
                                        <th>Tipo de Venda</th>
                                    </tr>

                                </thead>

                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-10 col-md-2">
                            <button type="submit" name="" class="btn btn-primary btn-block">Gerar XMl</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
@endsection

@section('script')
<script src="/js/plugins/dataTables/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#acessos_table').DataTable({
            ajax: {
                url: '{{ $url_api }}',
                dataSrc: '',
                headers: {
                    Accept : 'application/json',
                    Authorization: '{{ $token }}'
                }
            },
            columns: [
              { data: 'id' },
              { data: 'data_entrega'},
              { data: 'representante.codigo'},
              { data: 'cliente.nome'},
              { data: 'tipovenda.nome'}
            ]
        });
    });
</script>
@endsection
