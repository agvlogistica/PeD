@extends('layouts.app')

@section('title', 'Order Maker - Grupo Produto')

@section('style')
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>@yield('title')</h2>
    </div>
   	<div class="col-sm-6">
        <div class="title-action">
            <a href="" class="btn btn-primary" data-toggle='modal' data-target='#novo_prodgrupo_modal'><i class="fa fa-plus"></i> Cadastro</a>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Grupo de Produto</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="prodgrupo_table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Ativo</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('ordermaker._includes._novo_prodgrupo_modal')
@include('ordermaker._includes._editar_prodgrupo_modal')

@endsection

@section('script')
<script src="/js/plugins/dataTables/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        var prodgrupo_table = $('#prodgrupo_table').DataTable({
        	language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            ajax: {
                headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer {{ $token }}'
                    },
                url: 'http://localhost:8000/v2/ordermaker/prodgrupo/lista',
                dataSrc: '',
                type: 'GET'
            },
            columns: [
               	{
                    data: 'id'
                },
                {
                    data: 'codigo'
                },
                {
                    data: 'nome'
                },
                {
                    data: 'ativo'
                },
                {
                    data: null,
                    orderable: false,
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol){
                        $(nTd).html('<a href="" class="text-success edita-prodgrupo"><i class="fa fa-pencil-square-o"></i> </a> | <a href="" class="text-danger exclui-prodgrupo"><i class="fa fa-trash"></i> </a>');


                    }
                },
            ]
        });

     	$('#prodgrupo_table tbody').on('click', '.exclui-prodgrupo', function(e){
     		e.preventDefault();
        	var data = prodgrupo_table.row($(this).parents('tr')).data();
        	$.ajax({
        		headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer {{ $token }}'
                },
        		url: "http://localhost:8000/v2/ordermaker/prodgrupo/remove/"+data.id,
        		type: "DELETE"

        	})
        	.done( function(resp){
        		console.log(resp);
        		prodgrupo_table.ajax.reload();
        		toastr['success']('Excluido com Sucesso', 'Grupo Produto');
        	})
        	.fail(function(err){
        		console.log(err);
        		toastr['error']('Erro ao Excluir', 'Grupo Produto');
        	});
        });

        var novo_prodgrupo_modal = $('#novo_prodgrupo_modal');

        novo_prodgrupo_modal.on('shown.bs.modal', function(){
        	$('input:text').val('');
        	$('input:checkbox').prop('checked', true);
        	$('#codigo').focus();
        });

        novo_prodgrupo_modal.on('submit', 'form', function(e){
       		e.preventDefault();
        	$.ajax({
        		headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer {{ $token }}'
                },
        		url: "http://localhost:8000/v2/ordermaker/prodgrupo/novo",
        		type: "POST",
        		data: {
        			codigo: novo_prodgrupo_modal.find("#codigo").val(),
        			nome: novo_prodgrupo_modal.find("#nome").val(),
        			ativo: novo_prodgrupo_modal.find("#ativo").val()
        		}
        	})
        	.done(function(resp){
        		console.log(resp);
        		novo_prodgrupo_modal.modal("hide");
        		prodgrupo_table.ajax.reload();
        		toastr['success']('Cadastrado com Sucesso', 'Grupo Produto');
        	})
        	.fail(function(err){
        		console.log(err);
        		toastr['error']('Erro ao Cadastrar', 'Grupo Produto');
        	});
        });

        var editar_prodgrupo_modal = $('#editar_prodgrupo_modal');

        editar_prodgrupo_modal.on('shown.bs.modal', function(){
        	$('#codigo').focus();
        });

        $('#prodgrupo_table tbody').on('click', '.edita-prodgrupo', function(e){
     		e.preventDefault();
     		var data = prodgrupo_table.row($(this).parents('tr')).data();

        	editar_prodgrupo_modal.find("#id").val(data.id);
        	editar_prodgrupo_modal.find("#codigo").val(data.codigo);
        	editar_prodgrupo_modal.find("#nome").val(data.nome);
        	editar_prodgrupo_modal.find("#ativo").val(data.ativo);

        	editar_prodgrupo_modal.modal('show');
        });

        editar_prodgrupo_modal.on('submit', 'form', function(e){
       		e.preventDefault();
        	$.ajax({
        		headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer {{ $token }}'
                },
        		url: "http://localhost:8000/v2/ordermaker/prodgrupo/atualiza/"+editar_prodgrupo_modal.find("#id").val(),
        		type: "PUT",
        		data: {
        			codigo: editar_prodgrupo_modal.find("#codigo").val(),
        			nome: editar_prodgrupo_modal.find("#nome").val(),
        			ativo: editar_prodgrupo_modal.find("#ativo").val()
        		}
        	})
        	.done(function(resp){
        		console.log(resp);
        		editar_prodgrupo_modal.modal("hide");
        		prodgrupo_table.ajax.reload();
        		toastr['success']('Cadastrado com Sucesso', 'Grupo Produto');
        	})
        	.fail(function(err){
        		console.log(err);
        		toastr['error']('Erro ao Cadastrar', 'Grupo Produto');
        	});
        });
    });
</script>
@endsection
