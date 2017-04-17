<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alvo+ | @yield('title')</title>

    @include('layouts._includes._styles')
</head>

<body class="">

    <div id="wrapper">
        @include('layouts._includes._nav')

        <div id="page-wrapper" class="gray-bg">

            @include('layouts._includes._header')

            @yield('content')

            @include('layouts._includes._footer')

        </div>
    </div>

    @include('layouts._includes._scripts')
</body>
</html>
