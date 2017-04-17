@extends('layouts.app')

@section('title', 'Order Maker - Inclusão Pedido')

@section('style')
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <table class="table">
            <td><img src="/img/asset_upload_file89_38151.png"></td>
            <td>
                <div class="text-center">
                    <h2>Inclusão de Pedidos</h2>
                </div>
            </td>
        </table>
        <ol class="breadcrumb">
            <li><a href="/">&nbsp;&nbsp;&nbsp;&nbsp;Início</a></li>
            <li class="active"><strong>Inclusao Pedidos</strong></li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="ibox-tools">
                       <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form id="principal" type="submit" class="form-horizontal" >

                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                        <input name="motivo_reprova" id="motivo_reprova" type="hidden" type="text" class="form-control"  >
                        <input name="edi" id="edi" type="hidden" type="text" class="form-control"  >
                        <input name="data_edi" id="data_edi" type="hidden" type="text" class="form-control"  >
                        <input name="status" id="status" type="hidden" type="text" class="form-control" value="2">
                        <input name="numero_item"  id="numero_item" type="hidden" type="number" class="form-control" value="1">
                        <input name="representante_id"  id="representante_id" type="hidden" type="number" class="form-control" value="">

                        <div class="form-group">
                            <div class="col-md-2">
                                <label>Nº Pedido</label>
                                <input id="pedido_id" type="text" class="form-control" name="id" placeholder="numero do pedido" value="" readonly>
                            </div>
                            <div class="col-sm-2">
                                <label>Cód. Colaborador</label>
                                <input name="representante_codigo" id="representante_codigo" type="text" onchange="incluiNome(this.value);" class="form-control" value="">
                            </div>
                            <div class="col-md-6">
                                <label>Nome Colaborador</label>
                                <input disabled type="text" class="form-control" id="nome_colaborador">
                            </div>
                            <div class="col-md-2" id="data_1">
                                <label>Data Fatura</label>
                                <input name='data_fatura' id="data_fatura"  type="date" class="form-control" value= "">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label>Pedido Cliente</label>
                                <input name='pedido_cliente' id="pedido_cliente" type="text" class="form-control" >
                            </div>
                            <div class="col-sm-4">
                                <label for="">Tipo de Documento</label>
                                <select name='tipovenda_id' id='tipovenda_id' class="form-control">
                                    <option value="">Selecione..</option>
                                    @foreach($tipovenda as $r)
                                        <option value="{{$r->id}}">{{$r->codigo}} {{$r->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Condição de Pagamento</label>
                                    <select name='condpagto_id' id='condpagto_id' class="form-control">
                                        <option value="">Selecione..</option>
                                        @foreach($condpagto as $r)
                                            <option value="{{$r->id}}">{{$r->codigo}} {{$r->nome}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-md-2" id="data_2">
                                <label>Data Entrega</label>
                                <input name='data_entrega' id="data_entrega"  type="date" class="form-control" value= "">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <div class="col-md-1">
                                <label for="">UF</label>
                                <select id="uf" name="" onchange="filtraCidades(this.value);" class="form-control" style="width: 70px">
                                    <option value="">Selecione..</option>
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AM">AM</option>
                                    <option value="AR">AP</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MG">MG</option>
                                    <option value="MS">MS</option>
                                    <option value="MT">MT</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="PR">PR</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="RS">RS</option>
                                    <option value="SC">SC</option>
                                    <option value="SE">SE</option>
                                    <option value="SP">SP</option>
                                    <option value="TO">TO</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Cidade</label>
                                <select name="cidades" id='cidades' onchange="filtraClientes(this.value)" class="form-control">
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Recebedor da Mercadoria</label>
                                <select name="cliente_id" id='cliente_id' onchange="adicionaisCliente(this.value)" class="form-control">
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label for="cnpj">CNPJ</label>
                                <input disabled type="text" class="form-control" id="cnpj">
                            </div>
                            <div class="col-sm-2">
                                <label for="end_faturamento">SP</label>
                                <input disabled type="text" class="form-control" id="end_faturamento">
                            </div>
                            <div class="col-sm-2">
                                <label for="end_entrega">SH</label>
                                <input disabled type="text" class="form-control" id="end_entrega">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="">Observações do Pedido</label>
                                <span style="padding-left:200px"></span>
                                <textarea name='obs_pedido' id='obs_pedido' rows="3" cols="80"  placeholder="Observações"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">Observações da NF</label>
                                <span style="padding-left:200px"></span>
                                <textarea name='obs_faturamento' id='obs_faturamento' rows="3" cols="80" placeholder="Observações"></textarea>
                            </div>
                            <div class="col-md-offset-0 col-md-2">
                                <button enabled id="btn_gravar" type="submit" class="btn btn-primary btn-block">Gravar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" method="post">
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label for="pedido">Total de Itens</label>
                                    <input disabled type="text" class="form-control" name="total_itens" id="total_itens" placeholder="" value="0">
                                </div>
                                <div class="col-md-2">
                                    <label for="pedido">QTD Total</label>
                                    <input disabled type="text" class="form-control" name="qtd_total" id="qtd_total" placeholder="" value="0">
                                </div>
                                <div class="col-md-2">
                                    <label for="pedido">Total</label>
                                    <input disabled type="text" class="form-control" name="total" id="total" placeholder="" value="0">
                                </div>
                                <div class="col-md-2">
                                    <label for="pedido">Desconto (%)</label>
                                    <input disabled type="text" class="form-control" name="desconto" id="desconto" placeholder="" value="0">
                                </div>
                                <div class="col-md-2">
                                    <label for="pedido">Geral</label>
                                    <input disabled type="text" class="form-control" name="geral" id="geral" placeholder="" value="0">
                                </div>
                            </div>
                         </form>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <form id="item_form" class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label for="prodgrupo">Grupo</label>
                                        <select disabled id="prodgrupo" name="prodgrupo_id" class="form-control" onchange="filtraProduto(this.value);">
                                            <option value="">Selecione...</option>
                                            @foreach ($prodgrupo as $item)
                                                <option value="{{ $item->id }}">{{ $item->codigo }} {{ $item->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="produtos">Produto</label>
                                        <select id="produtos" name="produto_id" class="form-control" onchange="habilitaCampos(this.value);" disabled>
                                            <option value="">Selecione...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="qtd_item">Qtd</label>
                                        <input type="number" id="qtd_item" name="qtd" value="" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="preco_item">Preço</label>
                                        <input type="number" id="preco_item" name="preco" value="" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="desconto_item">Desconto (%)</label>
                                        <input type="number" id="desconto_item" name="desconto" value="" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="control-label">&nbsp;</label>
                                        <button id="grava_item" type="submit" class="btn btn-primary btn-block" disabled><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                                <div class="table-responsive">
                                    <table id="peditens_table" class="table table-bordered table-hover" cellspacing="0" width="100%" style="...">
                                        <thead>
                                            <tr>
                                                <th>Codigo </th>
                                                <th>Produto</th>
                                                <th>Quantidade</th>
                                                <th>Apresentação</th>
                                                <th>Unitario</th>
                                                <th>Desconto</th>
                                                <th>Unitario c/ Desconto</th>
                                                <th>Subtotal</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                    </div>
                <div class="col-lg-15">
                    <div class="ibox float-e-margins">
                            <div class="modal inmodal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        </div>
                                        <div class="modal-header">
                                            </ul>
                                                <div class="tab-content">
                                                    <div id="bovino2" class="tab-pane fade in active">
                                                        <h1>Bovinos</h1>
                                                        <div class="table-responsive">
                                                            <table id="grupos_table" class="table table-bordered table-hover"     cellspacing="0" width="100%" style="...">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>Codigo </th>
                                                                        <th>Produto</th>
                                                                        <th>Quantidade</th>
                                                                        <th>Apresentação</th>
                                                                        <th>Unitario</th>
                                                                        <th>Desconto</th>
                                                                        <th>Unitario c/ Desconto</th>
                                                                        <th>Subtotal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><input type="checkbox"></td>
                                                                        <td>AF140425KBL</td>
                                                                        <td>RUMENSIN 100 RASTREAVEL</td>
                                                                        <td><input type="number" class="form-control" style="width: 100px"></td>
                                                                        <td>Saco(s) de 25KG</td>
                                                                        <td>166,40</td>
                                                                        <td><input type="number" class="form-control" style="width: 70px"></td>
                                                                        <td>130,01</td>
                                                                        <td>2.600,20</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><input type="checkbox"></td>
                                                                        <td>AF140425KBL</td>
                                                                        <td>RUMENSIN 100 RASTREAVEL</td>
                                                                        <td><input type="number" class="form-control" style="width: 100px"></td>
                                                                        <td>Saco(s) de 25KG</td>
                                                                        <td>166,40</td>
                                                                        <td><input type="number" class="form-control" style="width: 70px"></td>
                                                                        <td>130,01</td>
                                                                        <td>2.600,20</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-primary">Salve</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
	<script src="/js/plugins/iCheck/icheck.min.js"></script>
	<script src="/js/plugins/dataTables/datatables.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            var peditens_table = $('#peditens_table').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
                },
                ajax: {
                    headers: {
                            'Accept': 'application/json',
                            'Authorization': '{{ $token }}'
                        },
                    url: '{{ $url_pediten_lista }}?pedido_id='+$("#pedido_id").val(),
                    dataSrc: 'data',
                    type: 'GET'
                },
                columns: [
                   	{
                        data: 'produto.codigo'
                    },
                    {
                        data: 'produto.nome'
                    },
                    {
                        data: 'qtd'
                    },
                    {
                        data: 'produto.unidade'
                    },
                    {
                        data: 'preco'
                    },
                    {
                        data: 'desconto'
                    },
                    {
                        data: null,
                        render: function ( data, type, row ) {
                            return Math.round( row.preco * (1 - (row.desconto/100)) );
                        }
                    },
                    {
                        data: null,
                        render: function ( data, type, row ) {
                            return Math.round( row.qtd * (row.preco * (1 - (row.desconto/100))) );
                        }
                    },
                    {
                        data: 'id',
                        orderable: false,
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol){
                            $(nTd).html('<a href="" class="text-danger" onclick="excluiItem('+sData+')"><i class="fa fa-trash"></i> </a>');
                        }
                    },
                ]
            }); //pediten

            $('#grupos_table').DataTable({

                dom: 'lTfgitp',
                buttons: [

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

            }); //grupos_table

            $("#item_form").on('submit', function(e){
                
                var valor = $('#numero_item').val();
                var proximo_item = parseInt(valor);
                var pedido_id = $('#pedido_id').val();
                
                e.preventDefault();
                $.ajax({
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': '{{ $token }}'
                    },
                    url: "{{ $url_pediten }}",
                    type: "POST",
                    data: {
                        pedido_id: $('#pedido_id').val(),
                        numero_item: proximo_item,
                        produto_id: $('#produtos').val(),
                        qtd: $('#qtd_item').val(),
                        preco: $('#preco_item').val(),
                        desconto: $('#desconto_item').val()
                    }
                })
                .done(function(resp){
                    console.log(resp);
                    peditens_table.ajax.reload();
                    toastr['success']('Cadastrado com Sucesso', 'Item do Pedido');
                    $('#numero_item').val(proximo_item = proximo_item + 1);
                    //traz totais
                    exibeTotais(pedido_id);
                    
                })
                .fail(function(err){
                    console.log(err);
                    toastr['error']('Erro ao Cadastrar', 'Item do Pedido');
                });

            }); //item_form

            $("#principal").on('submit', function(e){

                //NOVO
                var url_verbo = 'POST';
                var msg = 'Cadastra';
                var url_pedido = "{{ $url_pedido_novo }}";

                //ATUALIZA
                if ($('#pedido_id').val() > 0) {
                    url_pedido = "{{ $url_pedido_atualiza }}";
                    url_verbo = 'PUT';
                    msg = 'Atualiza';
                }

                e.preventDefault();
                $.ajax({
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': '{{ $token }}'
                    },
                    url: url_pedido,
                    type: url_verbo,
                    data: {
                        id:                 $('#pedido_id').val(),
                        cliente_id:         $('#cliente_id').val(),
                        representante_id:   $('#representante_id').val(),
                        tipovenda_id:       $('#tipovenda_id').val(),
                        condpagto_id:       $('#condpagto_id').val(),
                        obs_pedido:         $('#obs_pedido').val(),
                        obs_faturamento:    $('#obs_faturamento').val(),
                        data_fatura:        $('#data_fatura').val(),
                        data_entrega:       $('#data_entrega').val(),
                        motivo_reprova:     $('#motivo_reprova').val(),
                        pedido_cliente:     $('#pedido_cliente').val(),
                        status:             $('#status').val(),
                        edi:                $('#edi').val(),
                        data_edi:           $('#data_edi').val()
                    }
                })
                .done(function(resp){
                    console.log(resp);
                    toastr['success'](msg + 'do com Sucesso', 'Pedido');
                    $("#pedido_id").val(resp.data);
                    //$("#btn_gravar").prop("disabled", true);
                    peditens_table.ajax.url( '{{ $url_pediten_lista }}?pedido_id='+$("#pedido_id").val() ).load();
                    
                    if (url_verbo == 'POST') $("#pedido_id").val(resp.data);
                    else                     $("#pedido_id").val(resp.data.id);
                    
                    $("#prodgrupo").prop("disabled", false);
                })
                .fail(function(err){
                    console.log(err);
                    toastr['error']('Erro ao '+ msg + 'r', 'Pedido');
                });
            }); //principal
        }); //$(document)

        function exibeTotais(pedido_id){
            var total_itens = 0;
            var qtd_total = 0 ;
            var total = 0;
            var descontos = 0;
            var geral = 0;
            
            $.ajax({
                type:"GET",
                url: '{{ $url_pedido_totais }}'+pedido_id,
                headers: {
                    Accept : 'application/json',
                    Authorization: '{{ $token }}'
                },
                success: function(data){
                    console.log(data);
                    total_itens = data.itens;
                    qtd_total = data.qtd_total;
                    total = data.total;
                    descontos = data.descontos;
                    geral = data.geral;
                }
            }).done(function(){
                $("#total_itens").val(total_itens);
                $("#qtd_total").val(qtd_total);
                $("#total").val(total);
                $("#desconto").val(descontos);
                $("#geral").val(geral);
            }) ;
        }
        
        
        function incluiNome($id){
            var nome = '';
            var id_representante = 0;
            $.ajax({
                type:"GET",
                url: '{{ $url_representante }}'+$id,
                headers: {
                    Accept : 'application/json',
                    Authorization: '{{ $token }}'
                },
                success: function(data){
                    console.log(data);
                    if (data.sucess==true) { 
                        nome = data.data[0].user.name; 
                        id_representante = data.data[0].id;
                    }
                    else {
                        $("#representante_codigo").val('');
                        $("#representante_id").val('');
                        toastr['error']('Código inválido', 'Colaborador');
                    }
                }
            }).done(function(){
                $("#nome_colaborador").val(nome);
                $("#representante_id").val(id_representante);
            }) ;
        }; //incluiNome

        function excluiItem(id){ //akialdo
            $.ajax({
                type:"DELETE",
                url: '{{ $url_exclui_item }}'+id,
                headers: {
                    Accept : 'application/json',
                    Authorization: '{{ $token }}'
                }
            }).done(function(response){
                if (response.sucess==true) {
                    toastr['success']('Item', 'Excluido com sucesso!');
                }
                else {
                    toastr['error']('Item', 'Erro ao excluir o item!');
                }
            }) ;
        }; //excluiItem

        function filtraCidades($uf){
            var $cidade = "<option value=''>Selecione.. </option>";
            $.ajax({
                type:"GET",
                url: '{{ $url_cidade }}' + $uf,
                headers: {
                    Accept : 'application/json',
                    Authorization: '{{ $token }}'
                }
            }).done(function(data){
                if (data.sucess==true) {
                    for (i=0; i<data.data.length; i++) {
                        $cidade += "<option value="+data.data[i].cidade+" > " + data.data[i].cidade +" </option>"
                    }
                    $("#cidades").html($cidade);
                }
            }) ;
        }; //filtraCidades

        function filtraProduto(prodgrupo_id){
            var produtos = '<option value="">Selecione...</option>';

            if (prodgrupo_id != "") {
                $.ajax({
                    type:"GET",
                    url: '{{ $url_produto }}'+ '?prodgrupo_id=' + prodgrupo_id,
                    headers: {
                        Accept : 'application/json',
                        Authorization: '{{ $token }}'
                    }
                }).done(function(response){
                    if (response.sucess==true) {
                        for (i=0; i<response.data.length; i++) {
                            produtos += "<option value="+response.data[i].id+">" + response.data[i].codigo + " " + response.data[i].nome +" </option>";
                        }
                        $("#produtos").html(produtos);
                        $("#produtos").prop("disabled", false);
                    }
                }) ;
            } else {
                $("#produtos").html(produtos);
                $("#produtos").prop("disabled", true);
            }
        }; //filtraProdutos

        function habilitaCampos(produto_id){
            if (produto_id != "") {
                $("#qtd_item").prop("disabled", false);
                $("#preco_item").prop("disabled", false);
                $("#desconto_item").prop("disabled", false);
                $("#grava_item").prop("disabled", false);
            } else {
                $("#qtd_item").prop("disabled", true);
                $("#preco_item").prop("disabled", true);
                $("#desconto_item").prop("disabled", true);
                $("#grava_item").prop("disabled", true);
            }
        }; //habilitaCampos

        function filtraClientes($cidade){
            var $cliente = "<option value=''>Selecione.. </option>";
            var $uf = document.getElementById('uf').value;

            $.ajax({
                type:"GET",
                url: '{{ $url_cliente }}' + '?uf=' + $uf + '&cidade=' + $cidade ,
                headers: {
                    Accept : 'application/json',
                    Authorization: '{{ $token }}'
                }
            }).done(function(data){
                if (data.sucess==true) {
                    for (i=0; i<data.data.length; i++) {
                        $cliente += "<option value="+data.data[i].id+" > " + data.data[i].nome +" </option>"
                    }
                    $("#cliente_id").html($cliente);
                }
            }) ;
        }; //filtraClientes

        function adicionaisCliente($id){
            var nome = '';
            var cnpj = '';
            var end_faturamento = '';
            var end_entrega = '';

            $.ajax({
                type:"GET",
                url: '{{ $url_cliente_id }}'+$id,
                headers: {
                    Accept : 'application/json',
                    Authorization: '{{ $token }}'
                },
                success: function(data){
                    if (data.sucess==true) {
                        cnpj = data.data.cnpj;
                        end_faturamento = data.data.end_faturamento;
                        end_entrega = data.data.end_entrega;
                    }
                }
            }).done(function(){
                $("#cnpj").val(cnpj),
                $("#end_faturamento").val(end_faturamento),
                $("#end_entrega").val(end_entrega);
            }) ;
        }; //adicionaisCliente
    </script>
@endsection
