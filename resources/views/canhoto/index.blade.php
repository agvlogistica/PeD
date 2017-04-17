 @extends('layouts.app')

@section('title', 'Canhotos')

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
                        <form role="form" method="post">
                            <input type="hidden" name="codtransp" id="codtransp" value="{{ $transportadora }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group form-group-sm">
                                        <label>De:</label>
                                        <div class="input-group date">
                                            <input type="text" id="dataIni" value="{{ Date('d/m/Y', strtotime('-7 day')) }}" class="form-control input-sm" data-mask='99/99/9999'>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-sm">
                                        <label>Até:</label>
                                        <div class="input-group date">
                                            <input type="text" id="dataFim" value="{{ Date('d/m/Y') }}" class="form-control input-sm" data-mask='99/99/9999'>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-sm">
                                        <label for="cte_numero">CTe</label>
                                        <input type="text" id="cte_numero" class="form-control"  />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-sm">
                                        <label for="remetente">Cliente / Remetente</label>
                                        <input type="text" id="remetente" class="form-control"  />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-sm">
                                        <label for="nf_canhoto">Notas Fiscais</label>
                                        <select class="form-control" name="nf_canhoto" id="nf_canhoto">
                                            <option value="">Todas</option>
                                            <option value="1" selected>Com Imagem</option>
                                            <option value="2">Sem Imagem</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group form-group-sm">
                                        <label for="destinatario">Destinatário</label>
                                        <input type="text" id="destinatario" class="form-control"  />
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-group-sm">
                                        <label for="destino">Destino</label>
                                        <input type="text" id="destinocid" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-sm">
                                        <label>&nbsp;</label>
                                        <input type="button" name="btnload" id="btnload" class="btn btn-primary btn-block btn-sm" value="Filtrar"/>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>CT-e | Transportadora: {{ $transportadora ? $transportadora : 'Todas'}}</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table id="ctes_table" class="table table-striped table-bordered table-hover" width="100%" style='font-size: 10px;'>
                                <thead>
                                    <tr>
                                        <th>CTe</th>
                                        <th>Origem</th>
                                        <th>Cliente</th>
                                        <th>Destinatário</th>
                                        <th>Destino</th>
                                        <th>Emissão</th>
                                        <th>Comprovantes</th>
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
    <script src="/js/plugins/datapicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
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
                orientation: 'bottom auto'
            });

            var table = $('#ctes_table').DataTable({
                processing: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json",
                    decimal: ",",
                    thousands: ".",
                },

                ajax: {

                    url: '{!! $url_api !!}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer {{ $token_api }}'
                    },
                    dataSrc: '',
                    type:'POST',
                    data:function(){
                        var param = {};

                        param.transp_codigo     = $('#codtransp').val();
                        param.cte_data_inicial  = $('#dataIni').val();
                        param.cte_data_final    = $('#dataFim').val();
                        param.remetente         = $('#remetente').val();
                        param.destinatario      = $('#destinatario').val();
                        param.destino           = $('#destinocid').val();
                        param.cte_numero        = $('#cte_numero').val();
                        param.nf_canhoto        = $('#nf_canhoto').val();

                        return param;
                    }
                },

                columns: [
                    {   data:           "cte_numero",
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol){
                            if (oData.cte_numero != " " )
                            {
                                $(nTd).html("<a href='/canhoto/detalhe/"+oData.cte_id+"'>"+ oData.cte_numero+"</a>");
                            }
                        }
                    },
                    { data: "emitente_cte.pessoa.pes_nome"        },
                    { data: "notas_fiscais.0.emitente_nf.pessoa.pes_nome"     },
                    { data: "notas_fiscais.0.destinatario.pessoa.pes_nome"  },
                    { data: "destino.cid_cidade"  },
                    { data: "cte_data"      },
                    {
                        "orderable":      false,
                        "data":           "cte_id",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol){
                            var icone = '<i class="fa fa-ban" aria-hidden="true" data-toggle="tooltip" title="Quantidade de Comprovante"></i>';

                            var numero_nfs = oData.notas_fiscais.length;

                            var numero_canhotos = 0;

                            for (var i = 0; i < numero_nfs; i++) {
                                if (oData.notas_fiscais[i].nf_canhoto != '') {
                                    numero_canhotos++;
                                }
                            }

                            if (numero_canhotos == numero_nfs) {
                                icone = '<i class="fa fa-check" aria-hidden="true" data-toggle="tooltip" title="Quantidade de Comprovante"></i>'
                            }

                            icone = (icone + " " + numero_canhotos + '/' +numero_nfs);

                            $(nTd).html(icone);

                        }
                    }
                ],
                order: [0, "desc"],
            });

            $('#btnload').on('click',function(e){
                e.preventDefault();
                table.ajax.reload();
            });

        });
    </script>
@endsection
