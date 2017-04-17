<!DOCTYPE html>
<html lang='pt-BR'>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alvo+ | @yield('title')</title>

    @include('layouts._includes._styles')

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated bounceIn">
        <div>
            <div class="wrapper wrapper-content">

                <img src="/img/Logo.png" alt="" class="img-responsive center-block" width="128"/>

            </div>

            <h3>Bem-vindo ao <strong>Alvo<span class="text-warning">+</span></strong></h3>
            @yield('content')
            <p class="m-t"> <small>Alvo Solutions &copy; 2016</small> </p>
        </div>
    </div>

    @include('layouts._includes._scripts')

</body>

</html>
