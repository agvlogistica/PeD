<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <!-- CSS Files -->
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="/css/animate.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
  <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
  <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">

  <!-- Js Files -->
  <script src="/js/jquery-2.1.1.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
  <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="/js/inspinia.js"></script>
  <script src="/js/plugins/pace/pace.min.js"></script>
  <script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script>
  <script src="/js/plugins/datapicker/locales/bootstrap-datepicker.pt-BR.js"></script>
  <script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>
  <script src="/js/plugins/dataTables/datatables.min.js"></script>
  <script src="/js/mask_plugin.js"></script>

  <style>
      .backwhite{
        background-color: white;
      }
  </style>
</head>
<body>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Baixa Entrega</h2>
            <ol class="breadcrumb">
                @yield('menu')
            </ol>
        </div>
        <div class="col-lg-3">
            <div class="title-action">
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                @yield('filtros')
                @yield('grid')
                @yield('cte')
            </div>
        </div>
    </div>
</body>
</html>
