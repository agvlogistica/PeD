@extends('layouts.app')

@section('title', 'Detalhes Cte')

@section('style')
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
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
            <li>
                <a href="{{ route('canhoto.index') }}">Lista</a>
            </li>
            <li class="active">
                <strong>Detalhes CTe</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Detalhes CTe</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Número</label>
                            <div class="col-sm-2">
                                <input type="hidden" name="cte_numero" value="{{ $cte->cte_numero }}" >
                                <p class="form-control-static">{{ $cte->cte_numero }}</p>
                            </div>
                            <label class="col-sm-1 control-label">Empresa</label>
                            <div class="col-sm-1">
                                <p class="form-control-static">{{ $cte->emitente_cte->codigo }}</p>
                            </div>
                            <label class="col-sm-1 control-label">Emissão</label>
                            <div class="col-sm-2">
                                <p class="form-control-static">{{ date('d/m/Y',strtotime($cte->cte_data)) }}</p>
                            </div>
                            <label class="col-sm-1 control-label">Previsão</label>
                            <div class="col-sm-3">
                                <p class="form-control-static">{{ date('d/m/Y',strtotime($cte->cte_previsao)) }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Remetente</label>
                            <div class="col-sm-7">
                                <p class="form-control-static">{{ $cte->notas_fiscais[0]->emitente_nf->pessoa->pes_nome }}</p>
                            </div>
                            <label class="col-sm-1 control-label">Origem</label>
                            <div class="col-sm-3">
                                <p class="form-control-static">{{ $cte->origem->cid_cidade." - ".$cte->origem->cid_uf }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Destinatário</label>
                            <div class="col-sm-7">
                                <p class="form-control-static">{{ $cte->notas_fiscais[0]->destinatario->pessoa->pes_nome }}</p>
                            </div>
                            <label class="col-sm-1 control-label">Destino</label>
                            <div class="col-sm-3">
                                <p class="form-control-static">{{ $cte->destino->cid_cidade." - ".$cte->destino->cid_uf }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista NFe</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="listaNotas_table" class="table table-striped table-bordered table-hover" style='font-size: 11px;'>
                            <thead>
                                <tr>
                                    <th>Número</th>
                                    <th>Série</th>
                                    <th>DataNF</th>
                                    <th>Comprovante</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('canhoto._includes._canhoto_modal')
@include('canhoto._includes._imagem_modal')
@include('canhoto._includes._exclui_modal')

@endsection

@section('script')
<script src="/js/plugins/dataTables/datatables.min.js"></script>
<script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Jasny -->
<script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<script type="text/javascript">

    $(function(){

        var table = $('#listaNotas_table').DataTable({

            processing: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json",
                decimal: ",",
                thousands: ".",
            },
            ajax: {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer {{ $token_api }}'
                },
                url: '{!! $json !!}',
                dataSrc: '',
            }, columns: [
                { data: "nf_id" },
                { data: "nf_serie" },
                { data: "nf_dt_entrega" },
                {
                    "className":      'tracking-control',
                    "orderable":      false,
                    "data":           "nf_chave",
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol){
                        var html = "<button class='btn btn-circle btn-default exibe-canhoto' type='button' data-toggle='modal' data-target='#canhoto_modal'><i class='fa fa-upload' aria-hidden='true' title='Enviar imagem'></i></button>";

                        if (oData.nf_canhoto != "" ) {
                            html += "&nbsp;<button class='btn btn-circle btn-primary exibe-imagem' type='button' data-toggle='modal' data-target='#imagem_modal'><i class='fa fa-picture-o' aria-hidden='true' title='Exibir imagem'></i></button>";
                            html += "&nbsp;<button class='btn btn-circle btn-danger exclui-imagem' type='button' data-toggle='modal' data-target='#exclui_modal'><i class='fa fa-trash' aria-hidden='true' title='Excluir imagem'></i></button>";
                        }

                        $(nTd).html(html);
                    }
                }
            ],
            order: [0, "desc"],
        });

        function exibeExclui(objDAP) {
            var exclui_modal = $("#exclui_modal");

            exclui_modal.find("#nf_id_controle").val(objDAP.nf_id_controle);
            exclui_modal.find("#canhoto_img").attr('src', objDAP.nf_canhoto);
        }

        $('#listaNotas_table tbody').on('click', '.exclui-imagem', function() {
            var data = table.row( $(this).parents('tr') ).data();
            exibeExclui(data);
        });

        function exibeImagem(objDAP) {
            var canhoto_modal = $("#imagem_modal");

            canhoto_modal.find("#nf_id_controle").val(objDAP.nf_id_controle);
            canhoto_modal.find("#canhoto_img").attr('src', objDAP.nf_canhoto);
        }

        $('#listaNotas_table tbody').on('click', '.exibe-imagem', function() {
            var data = table.row( $(this).parents('tr') ).data();
            exibeImagem(data);
        });

        function exibeCanhoto(objDAP) {
            var canhoto_modal = $("#canhoto_modal");

            canhoto_modal.find("#nf_id_controle").val(objDAP.nf_id_controle);
        }

        $('#listaNotas_table tbody').on('click', '.exibe-canhoto', function() {
            var data = table.row( $(this).parents('tr') ).data();
            exibeCanhoto(data);
        });

    });
</script>

@endsection
