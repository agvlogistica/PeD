@extends('layouts.app')

@section('title', 'Portal CSC - Panorama Docs. em Trânsito')

@section('style')
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>@yield('title')</h2>
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
                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group form-group-sm">
                            <label class="col-md-1 control-label">De:</label>
                            <div class="col-md-2">
                                <div class="input-group date">
                                    <input type="text" id="data_inicial" value="{{ Date('d/m/Y', strtotime('-365 day')) }}" class="form-control input-sm" data-mask='99/99/9999'>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                            <label class="col-md-1 control-label">Até:</label>
                            <div class="col-md-2">
                                <div class="input-group date">
                                    <input type="text" id="data_final" value="{{ Date('d/m/Y') }}" class="form-control input-sm" data-mask='99/99/9999'>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-md-offset-4 col-md-2">
                                <button type="submit" id="filtrar_button" class="btn btn-primary btn-block btn-sm"><i class="fa fa-search"></i> Filtrar</button>
                            </div>
                        </div>
                    </form>
                    <hr>

                    <div class="table-responsive">
                        <table id="panorama_table" class="table table-striped table-hover" style="font-size: 11px">
                            <thead>
                                <tr>
                                    <th>Motivo</th>
                                    <th>Descrição Motivo</th>
                                    <th>Etapa</th>
                                    <th>Qtde</th>
                                    <th>Total Nota</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- ibox-content -->
            </div> <!--ibox float-e-margins -->

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
        $('#data_inicial').focus();

        $('.input-group.date').datepicker({
            keyboardNavigation: false,
            autoclose: true,
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            showOnFocus: false,
            orientation: 'bottom auto',
            todayBtn: true
        });

        var panorama_table = $('#panorama_table').DataTable({
            processing: true,
            order: [],
            autoWidth: false,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            ajax: {
                url: '{!! $api_url !!}',
                dataSrc: '',
                type: 'POST',
                data: function() {
                    var post_data = {};

                    post_data.data_inicial = $("#data_inicial").val();
                    post_data.data_final   = $("#data_final").val();

                    return post_data;
                }
            },
            dom: "<'html5buttons'B>lfrt<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'excelHtml5',
                }
            ],
            columns: [
                {
                    data: 'motivo'
                },
                {
                    data: 'descricao'
                },
                {
                    data: 'etapa'
                },
                {
                    className: 'text-right',
                    data: 'qtde',
                    type: "num",
                },
                {
                    className: 'text-right',
                    data: 'total_notas',
                    type: "num",
                    render: $.fn.dataTable.render.number( '.', ',', 2),
                }
            ]
        });

        $('#filtrar_button').on('click',function(e){
            e.preventDefault();
            panorama_table.ajax.reload();
        });

    });


</script>
@endsection
