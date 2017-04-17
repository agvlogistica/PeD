@extends('layouts.app')

@section('title', 'Portal Fornecedor')

@section('style')
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
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
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Filtros</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form role="form" action="{{ route('portal_fornecedor.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="nota_fiscal">Nota Fiscal</label>
                                    <input type="text" id="nota_fiscal" name="nota_fiscal" value="{{ $nota_fiscal }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="pedido">Pedido</label>
                                    <input type="text" id="pedido" name="pedido" value="{{ $pedido }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="data_emissao">
                                    <label>Data Emissão</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" name="emissao_inicial" value="{{ $emissao_inicial }}" class="form-control">
                                        <span class="input-group-addon">à</span>
                                        <input type="text" name="emissao_final" value="{{ $emissao_final }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group" id="data_previsao">
                                    <label>Data Previsão</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" name="previsao_inicial" value="{{ $previsao_inicial }}" class="form-control">
                                        <span class="input-group-addon">à</span>
                                        <input type="text" name="previsao_final" value="{{ $previsao_final }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="data_pagamento">
                                    <label>Data Pagamento</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" name="pagamento_inicial" value="{{ $pagamento_inicial }}" class="form-control">
                                        <span class="input-group-addon">à</span>
                                        <input type="text" name="pagamento_final" value="{{ $pagamento_final }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class='btn btn-primary btn-block'>Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Notas Fiscais</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="nfs_table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nota Fiscal</th>
                                    <th>Perdido Compra</th>
                                    <th>Data Emissão</th>
                                    <th>Data Inclusão</th>
                                    <th>Valor</th>
                                    <th>Valor Parcela</th>
                                    <th>Data Previsão</th>
                                    <th>Data Pagamento</th>
                                    <th>Valor Pago</th>
                                </tr>
                            </thead>
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
<script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/js/plugins/datapicker/locales/bootstrap-datepicker.pt-BR.js"></script>
<!-- Input Mask-->
<script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#nfs_table').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json",
                decimal: ",",
                thousands: ".",
            },
            ajax: {
                url: '{!! $url !!}',
                dataSrc: ''
            },
            columnDefs: [
                { className: "text-right", "targets": [ 4,5,8 ] }
            ],
            columns: [
                { "data": "nota_fiscal" },
                { "data": "pedido_compra" },
                { "data": "data_emissao" },
                { "data": "data_inclusao" },
                {
                    data: "valor",
                    type: "num",
                    render: $.fn.dataTable.render.number( '.', ',', 2),
                },
                {
                    data: "valor_parcela",
                    type: "num",
                    render: $.fn.dataTable.render.number( '.', ',', 2),
                },
                { "data": "data_previsao" },
                { "data": "data_pagamento" },
                {
                    data: "valor_pago",
                    type: "num",
                    render: $.fn.dataTable.render.number( '.', ',', 2),
                }
            ],
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

        $('#data_emissao .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: 'dd/mm/yyyy',
            language: 'pt-BR'
        });

        $('#data_previsao .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: 'dd/mm/yyyy',
            language: 'pt-BR'
        });

        $('#data_pagamento .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: 'dd/mm/yyyy',
            language: 'pt-BR'
        });
    });
</script>
@endsection
