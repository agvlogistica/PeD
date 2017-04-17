@extends('layouts.app')

@section('content')
  @include('BaixaEntrega.ocorrencia')
  @section('menu', 'Baixa de Entrega')
  @section('title', 'Ocorrência')
  @section('menu_shortcut')
  <li class='active'><a href='{{ route("baixaentrega") }}'>Lista</a></li>
  <li class='active'><a href='{{ route("carregacte",["cte" => $cte->cte_id]) }}'>CT-e</a></li>
  <li class='active'><strong>Ocorrência</strong></li>
  @endsection
@endsection

@section('menu_title')
 @include('BaixaEntrega.menu')
@endsection

@section('style')
<link href="/css/animate.css" rel="stylesheet">
<link href="/css/style.css" rel="stylesheet">
<link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
@endsection
