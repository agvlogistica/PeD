@extends('layouts.app')

@section('title', 'Order Maker - Grupo Produto')

@section('style')
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <table class="table">
                <td><img src="/img/asset_upload_file89_38151.png"></td>
                <td><div class="text-center"><h2>Elanco Brasil</h2></div></td>
                </table>
                <ol class="breadcrumb">
                    <li><a href="/">&nbsp;&nbsp;&nbsp;&nbsp;Início</a></li>
                <li class="active"><strong>Lista</strong></li>
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
                        <div class=" text-center">
                            <h2>Painel de Aprovação de Pedidos</h2>
                        </div>
                        <div class="ibox float-e-margins">
                            <form class="form-horizontal" action=" " method="post">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <div class="input-group"><input type="text" placeholder="Num Pedido" class="input-sm form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button> 
                                            </span>
                                        </div>
                                        <div class="input-group"><input type="text" placeholder="Cliente" class="input-sm form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group"><input type="text" placeholder="Tipo Cliente" class="input-sm form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-search"></i>
                                                </button> 
                                            </span>
                                        </div>
                                        <div class="input-group"><input type="text" placeholder="Vendedor" class="input-sm form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group"><input type="text" placeholder="Status" class="input-sm form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-search"></i>
                                                </button> 
                                            </span>
                                        </div>
                                        <div class="input-group"><input type="text" placeholder="Motivo" class="input-sm form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group date"><input type="date" placeholder="" class="input-sm form-control"> 
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-calendar"></i>
                                                </button> 
                                            </span>
                                        </div>
                                        <div class="input-group"><input type="date" placeholder="" class="input-sm form-control"> 
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-calendar"></i>
                                                </button> 
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-md-offset-10 col-md-2">
                                            <button type="submit" name="gravar" class="btn btn-primary btn-block">Filtar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-15">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="ibox-tools">
                               <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </div>
                        </div>
                        <div class="ibox-content"> 
                            <div class="table-responsive">
                                <table id="grupos_table" class="table table-bordered table-hover" cellspacing="0" width="100%" style="...">
                                    <thead>
                                    <tr>
                                        <th>Num Pedido </th>
                                        <th>Data Pedido </th>
                                        <th>Cliente</th>
                                        <th>Tipo Cliente</th>
                                        <th>Vendedo</th>
                                        <th>Vlr. Pedido</th>
                                        <th>Status</th>
                                        <th>Motivo Aprovado</th>
                                        <th>   </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr> 
                                        <td>12345</td>
                                        <td>01/09/2016</td>
                                        <td>BRfoods</td>
                                        <td><i class="fa fa-star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></i></td>
                                        <td>EL1453</td>
                                        <td>R$ 250.000</td>
                                        <td>Aprovado &nbsp;&nbsp;<i class="fa fa-thumbs-o-up"></td>
                                        <td></td>
                                        <td><input type="checkbox"></td>
                                    </tr>
                                    <tr> 
                                        <td>545471</td>
                                        <td>01/08/2016</td>
                                        <td>Friboi</td>
                                        <td><i class="fa fa-star"><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></i></td>
                                        <td>EL1453</td>
                                        <td>R$ 250.000</td>
                                        <td>Aprovado &nbsp;&nbsp;<i class="fa fa-thumbs-o-up"></td>
                                        <td></td>
                                        <td><input type="checkbox"></td>
                                    </tr>
                                    <tr> 
                                        <td>873355</td>
                                        <td>01/08/2016</td>
                                        <td>BRfoods</td>
                                        <td><i class="fa fa-star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></i></td>
                                        <td>EL1453</td>
                                        <td>R$ 250.000</td>
                                        <td>Aprovado &nbsp;&nbsp;<i class="fa fa-thumbs-o-up"></td>
                                        <td></td>
                                        <td><input type="checkbox"></td>
                                    </tr>
                                    <tr> 
                                        <td>225566</td>
                                        <td>01/08/2016</td>
                                        <td>JBG</td>
                                        <td><i class="fa fa-star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></i></td>
                                        <td>EL1453</td>
                                        <td>R$ 250.000</td>
                                        <td>Aprovado &nbsp;&nbsp;<i class="fa fa-thumbs-o-up"></td>
                                        <td></td>
                                        <td><input type="checkbox"></td>
                                    </tr>
                                     <tr> 
                                        <td>112255</td>
                                        <td>01/08/2016</td>
                                        <td>BRfoods</td>
                                        <td><i class="fa fa-star"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></i></td>
                                        <td>EL1453</td>
                                        <td>R$ 250.000</td>
                                        <td>Aprovado &nbsp;&nbsp;<i class="fa fa-thumbs-o-up"></td>
                                        <td></td>
                                        <td><input type="checkbox"></td>
                                    </tr>
                                    <tr> 
                                        <td>123456</td>
                                        <td>01/08/2016</td>
                                        <td>BRfoods</td>
                                        <td><i class="fa fa-star"><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></i></td>
                                        <td>EL1453</td>
                                        <td>R$ 250.000</td>
                                        <td>Aprovado &nbsp;&nbsp;<i class="fa fa-thumbs-o-up"></td>
                                        <td></td>
                                        <td><input type="checkbox"></td>
                                    </tr>
                                    <tr> 
                                        <td>251478</td>
                                        <td>01/08/2016</td>
                                        <td>BRfoods</td>
                                        <td><i class="fa fa-star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></i></td>
                                        <td>EL1453</td>
                                        <td>R$ 250.000</td>
                                        <td>Aprovado &nbsp;&nbsp;<i class="fa fa-thumbs-o-up"></td>
                                        <td></td>
                                        <td><input type="checkbox"></td>
                                    </tr>
                                    <tr> 
                                        <td>965412</td>
                                        <td>01/08/2016</td>
                                        <td>JBG</td>
                                        <td><i class="fa fa-star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></i></td>
                                        <td>EL1453</td>
                                        <td>R$ 250.000</td>
                                        <td>Reprovado &nbsp;&nbsp;<i class="fa fa-thumbs-o-down"></td>
                                        <td></td>
                                        <td><input type="checkbox"></td>
                                    </tr>
                                    <tr> 
                                        <td>326598</td>
                                        <td>01/08/2016</td>
                                        <td>BRfoods</td>
                                        <td><i class="fa fa-star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></i></td>
                                        <td>EL1453</td>
                                        <td>R$ 250.000</td>
                                        <td>Aprovado &nbsp;&nbsp;<i class="fa fa-thumbs-o-up"></i></td>
                                        <td></td>
                                        <td><input type="checkbox"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-10 col-md-2">
                                <button type="submit" name="gravar" class="btn btn-primary btn-block">Gerar Interface</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
<script src="/js/plugins/dataTables/datatables.min.js"></script>
<script src="/js/plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
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

        });
    });
</script>

@endsection
