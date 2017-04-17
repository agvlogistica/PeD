@extends('layouts.app')

@section('content')
  @include('BaixaEntrega.abrecte')
  @section('title', 'CT-e')
  @section('menu', 'Baixa de Entrega')
  @section('menu_shortcut')
  <li class='active'><a href='{{ route("baixaentrega") }}'>Lista</a></li>
  <li class='active'><strong>CT-e</strong></li>
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
