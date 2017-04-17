@extends('layouts.app')

@section('content')
  @include('OrderVisibility.filtros')
  @include('OrderVisibility.armazem')
  @include('OrderVisibility.transporte')
  @include('OrderVisibility.modal')
@endsection

@section('style')
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<style>
  th, td { white-space: nowrap; overflow: hidden; };
</style>
@endsection

@section('script')
<script src="/js/plugins/dataTables/datatables.min.js"></script>
<script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/js/plugins/datapicker/locales/bootstrap-datepicker.pt-BR.js"></script>
<script>
  $(function(){

    //Formatando as datas
    $('.datas').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        language: 'pt-BR'
    });

    var dtini = '{!! $data_inicial !!}';
    var dtfim = '{!! $data_final !!}';
    //-------------------

    //Mudando a title do modal de acordo com a opção
    $('#view_nota').on('click',function(){
      $('#titlemsg').html("<i class='fa fa-clipboard'></i> Pedido ou NF Recebida");
      initDataTables({{ $recebidos['id'] }});
    });

    $('#view_separacao').on('click',function(){
      $('#titlemsg').html("<i class='fa fa-dropbox'></i> Em Separação");
      initDataTables({{ $separados['id'] }});
    });

    $('#view_expedicao').on('click',function(){
      $('#titlemsg').html("<i class='fa fa-archive'></i> Expedido do Armazém");
      initDataTables({{ $expedidos['id'] }});
    });

    $('#view_transporte').on('click',function(){
      $('#titlemsg').html("<i class='fa fa-truck'></i> Em Transporte");
      initDataTables({{ $transporte['id'] }});
    });

    $('#view_realizada').on('click',function(){
      $('#titlemsg').html("<i class='fa fa-check'></i> Entrega Realizada");
      initDataTables({{ $entregue['id'] }});
    });

    $('#view_ocorrencia').on('click',function(){
      $('#titlemsg').html("<i class='fa fa-tty'></i> Ocorrência na entrega");
      initDataTables({{ $ocorrencia['id'] }});
    });
    //----------------------------------------------

    function initDataTables(id){

      if ( $.fn.DataTable.isDataTable('#tblmodal') ) {
        $('#tblmodal').DataTable().destroy();
      }

      table = $("#tblmodal").DataTable({
        processing:true,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json",
        },
        autoWidth: false,
        ajax:{
          url:'{!! $url !!}',
          type:'POST',
          dataSrc: '',
          data:function(){
            var param = {};

            param.id            = id;
            param.visao         = 0;
            param.cnpj          = '{!! $cnpj !!}';
            param.data_inicial  = dtini;
            param.data_final    = dtfim;

            return param;
          }
        },
        columns: [
            { data: "origem"},
            { data: "pedido"},
            { data: "nf"},
            { data: "data"},
            { data: "destinatario"},
            { data: "cidade"},
            { data: "valor"},
            { data: "unidades"},
            { data: "volumes"},
            { data: "peso"},
            { data: "linha"}
        ],
        scrollX:true,
        dom: 'Bfrtipr',
        buttons: [
            'excel'
        ]
      });

    }

  });
</script>

@endsection
