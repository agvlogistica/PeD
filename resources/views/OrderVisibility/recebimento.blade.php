@extends('layouts.app')

@section('content')
<br>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Recebimento de Nota Fiscal</h5>
    <div class="ibox-tools"><a href="#" class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
  </div>
  <div class="ibox-content" style="display: block;">

    <div class="responsive-table">
      <table class="table table-striped table-hover" id="tblmodal">
        <thead>
          <th>Origem</th>
          <th>Pedido</th>
          <th>NF</th>
          <th>Data</th>
          <th>Destinatário</th>
          <th>Cidade</th>
          <th>UF</th>
        </thead>
      </table>
    </div>

  </div>
</div>
@endsection

@section('style')
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<style>
  th, td { white-space: nowrap; overflow: hidden; };
  div.container { width: 100%; }
</style>
@endsection

@section('script')
<script src="/js/plugins/dataTables/datatables.min.js"></script>
<script>
  $(function(){

    table = $("#tblmodal").DataTable({
      processing:true,
      language: {
          url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json",
      },
      ajax:{
        url:'http://localhost:8000/v1/lista_ctes',
        type:'POST',
        dataSrc: '',
        data:function(){
          var param = {};

          param.codtransp = 'TA152';

          return param;
        }
      },
      columns: [
          { data: "origem"},
          { data: "cte_numero"},
          { data: "cte_tipo_produto"},
          { data: "cte_data"},
          { data: "destinatario"},
          { data: "destinocid"},
          { data: "destinouf"}
      ],
      scrollX:true
    });

  });
</script>

@endsection
