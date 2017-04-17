@extends('layouts.app')

@section('title', 'Importação CSV')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>@yield('title')</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Início</a>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Selecione o Arquivo csv: (clientes / produtos / tabelaprecos / condpagto)</h5>
                </div>
                <div class="ibox-content">
                    <form enctype="multipart/form-data" class="form-horizontal" action="{{ route('ordermaker.importacsv')}}" method="post">
                        {{ csrf_field() }}
                        <!--
                        <div class="col-md-12">
                            <fieldset>
                                <div class="radio">
                                    <input type="radio" id="inlineRadio1" value="NovoCliente" name="radioInline" checked="">
                                    <label for="inlineRadio1"> Clientes (clientes.csv) </label>
                                </div>
                                <div class="radio">
                                    <input type="radio" id="inlineRadio2" value="NovoRepresentante" name="radioInline">
                                    <label for="inlineRadio2"> Representantes (representantes.csv)</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" id="inlineRadio3" value="NovoProduto" name="radioInline">
                                    <label for="inlineRadio3"> Produtos (produtos.csv)</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" id="inlineRadio4" value="NovoTabelapreco" name="radioInline">
                                    <label for="inlineRadio4"> Tabela de Preços (tabelaprecos.csv)</label>
                                </div>
                            </fieldset>
                        </div>
                        
                        <br></br>
                        <br></br>
                        <br></br>
                        <br></br>
                        -->
                        <div class="form-group">
                            <label for="arquivo" class="col-md-2 control-label">Arquivo de Importaçao:</label>
                            <div class="col-md-6">
                                <input type="file" id='arquivo' name="arquivo"  value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-10 col-md-2">
                                <button type="submit" name="importar" class="btn btn-primary btn-block">Importar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
