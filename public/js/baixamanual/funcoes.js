$(function(){
    montraGrid();

    $('.numero').mask('000000000');
    formataData();

    $("#status").on("change",function(){
      if($(this).val() == "8"){
        $("#data_entrega").prop("disabled",false);
      }else{
        $("#data_entrega").prop("disabled",true);
        $("#data_entrega").val('');
      }
    });

    $('#btngravar').on("click",function(){

      if($("#status").val() == ""){
        alert('Informe um status para o CTE.');

        return false;
      }

      if($("#status").val() == 9 && $("#data_entrega").val() == ""){
        alert('Informe uma data de entrega.');

        return false;
      }
    });

});

function montraGrid(){

  table = $("#grid").DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
              { extend: 'excel'}
            ],
            language: {
              search: "Buscar",
              paginate: {
                first:      "Primeiro",
                previous:   "Anterior",
                next:       "Próximo",
                last:       "Último"
              },
              lengthMenu:  "Mostrar _MENU_ ",
              info:        "Mostrando _START_ até _END_ de _TOTAL_ Registros",
              infoEmpty:   "Mostrando 0 até 0 de 0 Registros",
              infoFiltered:"(Filtrado(s) de  _MAX_ registros)",
              infoPostFix: "",
              zeroRecords: "Nenhum registro encontrado.",
              emptyTable:  "Nenhum registro encontrado",
            },
            scrollX:true
          });

  /*
  $('.toggle-vis').on( 'click', function (e) {
      e.preventDefault();

      // Get the column API object
      var column = table.column( $(this).attr('data-column') );

      // Toggle the visibility
      column.visible( ! column.visible() );
  } );
  */

  /*
  $("#grid .codcte").hover(function(){

    $(this).attr('style','cursor:pointer');

  });
  */

  /*
  $("#grid tbody").on('click','tr .codcte',function(){

    var cte = $(this).text();

    preencheDialog(cte);

    $(this).attr('data-target','#dialog-cte');
    $(this).attr('data-toggle','modal');
  });
  */
}

function formataData(){
  $('.datas').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR"
  });

  $('.datas').mask('00/00/0000');
}
