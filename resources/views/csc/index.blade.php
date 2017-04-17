@extends('layouts.app')

@section('title', 'Portal CSC')

@section('style')
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="/css/plugins/select2/select2.min.css" rel="stylesheet">
<link href="/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
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
                    <form class="" action="" method="post">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>De:</label>
                                    <div class="input-group date">
                                        <input type="text" id="dataIni" value="{{ Date('d/m/Y') }}" class="form-control input-sm" data-mask='99/99/9999'>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>De:</label>
                                    <div class="input-group date">
                                        <input type="text" id="dataFim" value="{{ Date('d/m/Y') }}" class="form-control input-sm" data-mask='99/99/9999'>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="refData">Período Ref.</label>
                                <select class="form-control input-sm" id="refData">
                                    <option value="1" selected>Inclusão DAP</option>
                                    <option value="2">Nota Fiscal</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="codigoPreRateio">DAP</label>
                                <input type="text" id="codigoPreRateio" value="" class="form-control input-sm">
                            </div>
                            <div class="col-md-2">
                                <label for="numeroNota">NF</label>
                                <input type="text" id="numeroNota" value="" class="form-control input-sm">
                            </div>
                            <div class="col-md-2">
                                <label for="valorNota">Valor</label>
                                <input type="number" id="valorNota" value="" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="fornecedor">Fornecedor</label>
                                <input type="text" id="fornecedor" value="" class="form-control input-sm">
                            </div>
                            <div class="col-md-2">
                                <label for="usuario">Incluso por</label>
                                <input type="text" id="usuario" value="" class="form-control input-sm">
                            </div>
                            <div class="col-md-2">
                                <label for="aprovador">Aprovador</label>
                                <input type="text" id="aprovador" value="" class="form-control input-sm">
                            </div>
                            <div class="col-md-4">
                                <label for="motivo">Motivo</label>
                                <select class="form-control" id="motivo">
                                    <option></option>
                                    @foreach ($motivos as $motivo)
                                        <option value="{{ $motivo->codigo }}">
                                            {{ $motivo->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>&nbsp;</label>
                                <button type="submit" id="filtrar_button" class="btn btn-primary btn-block btn-sm"><i class="fa fa-search"></i> Filtrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Relação de Documentos</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="lista_dap_table" class="table table-striped table-hover" style="font-size: 11px">
                            <thead>
                                <tr>
                                    <th>Trk</th>
                                    <th>Itens</th>
                                    <th>Vinc.</th>
                                    <th>PDF</th>
                                    <th>DAP</th>
                                    <th>Incluão</th>
                                    <th>Incluso por</th>
                                    <th>NF</th>
                                    <th>Data NF</th>
                                    <th>Valor</th>
                                    <th>CNPJ Fornecedor</th>
                                    <th>Fornecedor</th>
                                    <th>Tel Fornecedor</th>
                                    <th>Email Fornecedor</th>
                                    <th>Numero Processo</th>
                                    <th>Data Inc Processo</th>
                                    <th>Quem Inc Processo</th>
                                    <th>Previsão</th>
                                    <th>Pagamento</th>
                                    <th>Valor Pagar</th>
                                    <th>Status Baixa</th>
                                    <th>Cod Nivel Processo</th>
                                    <th>Descr Nivel Processo</th>
                                    <th>Aprovador</th>
                                    <th>Filial Nome</th>
                                    <th>Filial Local</th>
                                    <th>Vencto Nota</th>
                                    <th>Valor Pago</th>
                                    <th>Motivo</th>
                                    <th>Justificativa</th>
                                    <th>Meio Pagto</th>
                                    <th>Identificador</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- ibox-content -->
            </div> <!--ibox float-e-margins -->

        </div>
    </div>
</div>

@include('csc._includes._etapa_modal')

@include('csc._includes._item_modal')

@include('csc._includes._vinculo_modal')

@endsection

@section('script')
<script src="/js/plugins/dataTables/datatables.min.js"></script>
<script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/js/plugins/datapicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<!-- Select2 -->
<script src="/js/plugins/select2/select2.full.min.js"></script>
<!-- Input Mask-->
<script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $('#dataIni').focus();

        $('.input-group.date').datepicker({
            keyboardNavigation: false,
            autoclose: true,
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            showOnFocus: false,
            orientation: 'bottom auto',
            todayBtn: true
        });

        $("#motivo").select2({
            placeholder: "Selecione...",
            allowClear: true
        });

        var lista_dap_table = $('#lista_dap_table').DataTable({
            processing: true,
            order: [],
            autoWidth: false,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            ajax: {
                url: '{!! $api["API_URL_DAP"] !!}',
                dataSrc: '',
                type: 'POST',
                data: function() {
                    var post_data = {};

                    post_data.codigoPreRateio   = $("#codigoPreRateio").val();
                    post_data.numeroNota        = $("#numeroNota").val();
                    post_data.valorNota         = $("#valorNota").val();
                    post_data.dataIni           = $("#dataIni").val();
                    post_data.dataFim           = $("#dataFim").val();
                    post_data.refData           = $("#refData").val();
                    post_data.fornecedor        = $("#fornecedor").val();
                    post_data.usuario           = $("#usuario").val();
                    post_data.aprovador         = $("#aprovador").val();
                    post_data.motivo            = $("#motivo").val();
                    post_data.login             = '{{ $login }}';

                    return post_data;
                }
            },
            dom: '<"html5buttons"B>lTfgirtp',
            buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: '.export-column'
                    }
                }
            ],
            columns: [
                {
                    data: 'possui_etapa',
                    orderable: false,
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol){
                        $(nTd).html("");

                        if (sData == 1) {
                            $(nTd).html("<button class='btn btn-circle btn-default exibe-etapa' type='button' data-toggle='modal' data-target='#etapa_modal'><i class='fa fa-random' aria-hidden='true' title='Tracking'></i></button>");
                        }

                    }
                },
                {
                    data: 'possui_item',
                    orderable: false,
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol){
                        $(nTd).html("");

                        if (sData == 1) {
                            $(nTd).html("<button class='btn btn-circle btn-default exibe-item' type='button' data-toggle='modal' data-target='#item_modal'><i class='fa fa-bars' aria-hidden='true' title='Itens'></i></button>");
                        }
                    }
                },
                {
                    data: 'possui_vinculo',
                    orderable: false,
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol){
                        $(nTd).html("");

                        if (sData == 1) {
                            $(nTd).html("<button class='btn btn-circle btn-default exibe-vinculo' type='button' data-toggle='modal' data-target='#vinculo_modal'><i class='fa fa-tags' aria-hidden='true' title='Itens'></i></button>");
                        }
                    }
                },
                {
                    data: 'arquivo_docto',
                    orderable: false,
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol){
                        if (oData.arquivo_docto != "N/D" ) {
                            $(nTd).html("<a href='"+oData.arquivo_docto+"' target='_blank' class='btn btn-circle btn-default'>"+
                                "<i class='fa fa-file-pdf-o' aria-hidden='true'></i></a>");
                        } else {
                            $(nTd).html("");
                        }
                    }
                },
                {
                    className: 'export-column',
                    data: 'cod_pre_rat'
                },
                {
                    className: 'export-column',
                    data: 'data_inc_pre_rat'
                },
                {
                    className: 'export-column',
                    data: 'quem_inc_pre_rat'
                },
                {
                    className: 'export-column',
                    data: 'numero_nota_fiscal'
                },
                {
                    className: 'export-column',
                    data: 'data_nota_fiscal'
                },
                {
                    className: 'text-right export-column',
                    data: 'valor_nota_fiscal',
                    type: "num",
                    render: $.fn.dataTable.render.number( '.', ',', 2),
                },
                {
                    className: 'export-column',
                    data: 'cnpj_fornec',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'nome_fornec'
                },
                {
                    className: 'export-column',
                    data: 'tel_fornec',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'email_fornec',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'numero_processo',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'dat_inc_processo',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'quem_inc_processo',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'data_venc'
                },
                {
                    className: 'export-column',
                    data: 'data_baixa'
                },
                {
                    className: 'export-column',
                    data: 'valor_pagar',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'status_baixa',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'cod_nivel_processo',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'descr_nivel_processo',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'quem_aprova'
                },
                {
                    className: 'export-column',
                    data: 'filial_nome',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'filial_local',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'vencto_nota',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'valor_pago',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'motivo',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'justificativa'
                },
                {
                    className: 'export-column',
                    data: 'meio_pagto',
                    visible: false
                },
                {
                    className: 'export-column',
                    data: 'identificador',
                    visible: false
                }
            ]
        });

        var lista_etapa_table = $('#lista_etapa_table').DataTable({
            processing: true,
            order: [],
            autoWidth: false,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            ajax: {
                url: '{!! $api["API_URL_ETAPA"] !!}/0',
                dataSrc: ''
            },
            columns: [
                { data: 'etapa' },
                { data: 'aprovador' },
                { data: 'momento_aprovacao' },
                { data: 'desc_recusa' }
            ]
        });

        var lista_item_table = $('#lista_item_table').DataTable({
            processing: true,
            order: [],
            autoWidth: false,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            ajax: {
                url: '{!! $api["API_URL_ITEM"] !!}/0',
                dataSrc: ''
            },
            columns: [
                { data: 'data' },
                { data: 'conta' },
                { data: 'centro_custo' },
                { data: 'item' },
                { data: 'quantidade' },
                { data: 'valor_unitario' },
                { data: 'valor_total' },
                { data: 'observacao' }
            ]
        });

        var lista_vinculo_table = $('#lista_vinculo_table').DataTable({
            processing: true,
            order: [],
            autoWidth: false,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            ajax: {
                url: '{!! $api["API_URL_VINCULO"] !!}/0',
                dataSrc: ''
            },
            columns: [
                {
                    data: 'dap_origem',
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol){
                        $(nTd).html("<button class='btn btn-success btn-rounded btn-outline btn-block filtra-dap-origem' data-dismiss='modal'>"+sData+"</button>");
                    }
                },
                {
                    data: 'dap_destino',
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol){
                        $(nTd).html("<button class='btn btn-success btn-rounded btn-outline btn-block filtra-dap-destino' data-dismiss='modal'>"+sData+"</button>");
                    }
                }
            ]
        });

        $('#filtrar_button').on('click',function(e){
            e.preventDefault();
            lista_dap_table.ajax.reload();
        });

        $('#lista_vinculo_table tbody').on('click', '.filtra-dap-origem', function() {
            var data = lista_vinculo_table.row( $(this).parents('tr') ).data();
            filtrarDAP(data);
        });
        $('#lista_vinculo_table tbody').on('click', '.filtra-dap-destino', function() {
            var data = lista_vinculo_table.row( $(this).parents('tr') ).data();
            filtrarDAP(data, 1);
        });
        function filtrarDAP(oVinculo, tipo = 0) {
            $('#codigoPreRateio').val(tipo == 0 ? oVinculo.dap_origem : oVinculo.dap_destino);
            lista_dap_table.ajax.reload();
        }

        function exibeEtapa(objDAP) {
            var etapa_modal = $("#etapa_modal");

            etapa_modal.find("#cod_pre_rat").html(objDAP.cod_pre_rat);
            etapa_modal.find("#nome_fornec").html(objDAP.nome_fornec);
            etapa_modal.find("#numero_nota_fiscal").html(objDAP.numero_nota_fiscal);
            etapa_modal.find("#valor_nota_fiscal").html(objDAP.valor_nota_fiscal);
            etapa_modal.find("#numero_processo").html(objDAP.numero_processo);
            etapa_modal.find("#meio_pagto").html(objDAP.meio_pagto);
            etapa_modal.find("#motivo").html(objDAP.motivo);

            lista_etapa_table.ajax.url('{!! $api["API_URL_ETAPA"] !!}/' + objDAP.cod_pre_rat).load();
        }

        $('#lista_dap_table tbody').on('click', '.exibe-etapa', function() {
            var data = lista_dap_table.row( $(this).parents('tr') ).data();
            exibeEtapa(data);
        });

        function exibeItem(objDAP) {
            var item_modal = $("#item_modal");

            item_modal.find("#cod_pre_rat").html(objDAP.cod_pre_rat);
            item_modal.find("#nome_fornec").html(objDAP.nome_fornec);
            item_modal.find("#numero_nota_fiscal").html(objDAP.numero_nota_fiscal);
            item_modal.find("#valor_nota_fiscal").html(objDAP.valor_nota_fiscal);
            item_modal.find("#numero_processo").html(objDAP.numero_processo);
            item_modal.find("#meio_pagto").html(objDAP.meio_pagto);
            item_modal.find("#motivo").html(objDAP.motivo);

            lista_item_table.ajax.url('{!! $api["API_URL_ITEM"] !!}/' + objDAP.cod_pre_rat).load();
        }

        $('#lista_dap_table tbody').on('click', '.exibe-item', function() {
            var data = lista_dap_table.row( $(this).parents('tr') ).data();
            exibeItem(data);
        });

        function exibeVinculo(objDAP) {
            var vinculo_modal = $("#vinculo_modal");

            vinculo_modal.find("#cod_pre_rat").html(objDAP.cod_pre_rat);
            vinculo_modal.find("#nome_fornec").html(objDAP.nome_fornec);
            vinculo_modal.find("#numero_nota_fiscal").html(objDAP.numero_nota_fiscal);
            vinculo_modal.find("#valor_nota_fiscal").html(objDAP.valor_nota_fiscal);
            vinculo_modal.find("#numero_processo").html(objDAP.numero_processo);
            vinculo_modal.find("#meio_pagto").html(objDAP.meio_pagto);
            vinculo_modal.find("#motivo").html(objDAP.motivo);

            lista_vinculo_table.ajax.url('{!! $api["API_URL_VINCULO"] !!}/' + objDAP.cod_pre_rat).load();
        }

        $('#lista_dap_table tbody').on('click', '.exibe-vinculo', function() {
            var data = lista_dap_table.row( $(this).parents('tr') ).data();
            exibeVinculo(data);
        });


    });


</script>
@endsection
