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
                        <div class="ibox float-e-margins">
                            <div class=" text-center">
                                <h2>Cliente</h2>
                            </div>
                            <form class="form-horizontal" action=" " method="post">
                                <div class="form-group">
                                  	<div class="col-md-4">
                                    	<label>Nome</label>
                                        <input type="text" class="input-sm form-control">
                                    </div>
                                    <div class="col-md-2">
                                    	<label>CNPJ</label>                           
                                        <input type="text" class="input-sm form-control">
                                    </div>
                                    <div class="col-md-2">
                                     	<label>Tabela de Preços</label>                            
                                       	<input type="text" class="input-sm form-control">
                                    </div>
                                    <div class="col-md-2">
                                     	<label>Código SP</label>                            
                                       	<input type="text" class="input-sm form-control">
                                    </div>
                                    <div class="col-md-2">
                                     	<label>Código SH</label>                            
                                       	<input type="text" class="input-sm form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                <div class="col-md-1">
                                    <label for="">UF</label>
                                    <select id="UF" name="" class="form-control">
                                        <option value=""></option>
                                        <option value="1">AC</option>
                                        <option value="2">AL</option>
                                        <option value="4">AM</option>
                                        <option value="3">AP</option>
                                        <option value="5">BA</option>
                                        <option value="6">CE</option>
                                        <option value="7">DF</option>
                                        <option value="8">ES</option>
                                        <option value="10">GO</option>
                                        <option value="11">MA</option>
                                        <option value="14">MG</option>
                                        <option value="13">MS</option>
                                        <option value="12">MT</option>
                                        <option value="15">PA</option>
                                        <option value="16">PB</option>
                                        <option value="18">PE</option>
                                        <option value="19">PI</option>
                                        <option value="17">PR</option>
                                        <option value="20">RJ</option>
                                        <option value="21">RN</option>
                                        <option value="23">RO</option>
                                        <option value="9">RR</option>
                                        <option value="22">RS</option>
                                        <option value="25">SC</option>
                                        <option value="27">SE</option>
                                        <option value="26">SP</option>
                                        <option value="24">TO</option>
                                    </select>
                                </div>
                                   <div class="col-md-2">
                                    <label for="">Cidade</label>
                                    <select name="" class="form-control">
                                        <option value="">Cidade</option>
                                        <option value="">Cidade</option>
                                        <option value="">Cidade</option>
                                    </select>
                                </div>
                                 <div class="col-sm-4">
                                <label for="t_documento">Tipo de Documento</label>
                                <select class="form-control">
                                	<option>-- --</option>
                                    <option>Venda Triangular</option>
                                    <option>Venda R$</option>
                                    <option>Venda U$</option>                                
                                </select>                                
                            </div>
                            </div>
                          	<div class="form-group">
                    			<div class="col-md-offset-10 col-md-2">
                        			<button type="submit" name="gravar" class="btn btn-primary btn-block">Salvar</button>
                    			</div>
                			</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
