/@extends('layouts.app')

@section('content')
  @include('BaixaEntrega.filtros')
  @include('BaixaEntrega.grid')
  @section('title', 'Lista CT-e')
  @section('menu','Baixa de Entrega')
  @section('menu_shortcut',"<li class='active'><strong>Lista</strong></li>")
@endsection

@section('menu_title')
 @include('BaixaEntrega.menu')
@endsection

@section('style')
<link href="/css/animate.css" rel="stylesheet">
<link href="/css/style.css" rel="stylesheet">
<link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<style>
  th, td { white-space: nowrap; overflow: hidden; };
</style>
@endsection

@section('script')
<script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/js/plugins/datapicker/locales/bootstrap-datepicker.pt-BR.js"></script>
<script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script src="/js/plugins/dataTables/datatables.min.js"></script>
<script src="/js/mask_plugin.js"></script>
<script>
  $(function(){

    function converteData(data){
      var vet = data.split('-');
      var novadata = vet[2]+'/'+vet[1]+'/'+vet[0];

      return novadata;
    }

    table = $("#grid_cte").DataTable({
      processing:true,
      language: {
          url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json",
      },
      ajax:{
        url:'{!! $url !!}',
        type:'POST',
        dataSrc: '',
        data:function(){
          var param = {};

          param.codtransp     = $("#codtransp").val();
          param.cte           = $("#cte").val();
          param.remetente     = $("#remetente").val();
          param.origem        = $("#origem").val();
          param.nf            = $("#nf").val();
          param.destinatario  = $("#destinatario").val();
          param.destino       = $("#destino").val();
          param.dt_entrega    = '0000-00-00';

          return param;
        }
      },
      columns: [
          {
            data: "cte_numero",
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol){
              $(nTd).html("<a href='/carregacte/"+oData.cte_id+"'>"+ oData.cte_numero+"</a>");
            }
          },
          { data: "origem" },
          {
            data: "nf_valor",
            fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
              var nfvalor = parseFloat(oData.nf_valor);

              $(nTd).html(nfvalor);
            }
          },
          {
            data: "nf_volume",
            fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
              var nfvolume = parseFloat(oData.nf_volume);

              $(nTd).html(nfvolume);
            }
          },
          {
            data: "nf_peso",
            fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
              var nfpeso = parseFloat(oData.nf_peso);

              $(nTd).html(nfpeso);
            }
          },
          { data: "cte_tipo_produto" },
          { data: "remetente" },
          { data: "destinatario" },
          {
            data: "nf_cli_vip",
            fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
              if(oData.nf_cli_vip == 0){
                $(nTd).html('Não');
              }else{
                $(nTd).html('Sim');
              }
            }
          },
          { data: "destinocid" },
          {
            data: "cte_data",
            fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
              var ctedata = converteData(oData.cte_data);

              $(nTd).html(ctedata);
            }
          },
          {
            data: "cte_previsao",
            fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
              var cteprevisao = converteData(oData.cte_previsao);

              $(nTd).html(cteprevisao);
            }
          },
          { data: "status_cte"}
      ],
      scrollX:true,
      dom: '<"html5buttons"B>lTfgitpr',
      buttons: [
        { extend: 'excel'}
      ],
    });

    $('#btnfiltrar').on('click',function(){
      table.ajax.reload();
    });

  });
</script>
@endsection
