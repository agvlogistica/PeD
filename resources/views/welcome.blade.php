@extends('layouts.app')

@section('title', 'Início')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron animated bounceInRight">
                <div class="welcome-container">
                    <h1 class="text-center">Bem vindo ao <strong>{{ $css_template ? strtoupper($css_template) : 'Alvo'}}<span class="text-warning">+</span></strong></h1>
                    <h2 class="text-center"><strong class="text-warning">Pl</strong>ataforma <strong class="text-warning">U</strong>nificada de <strong class="text-warning">S</strong>oluções</h2>
                    <br>
                    <p class="text-center">
                        O <strong>{{ $css_template ? strtoupper($css_template) : 'Alvo'}}<span class="text-warning">+</span></strong> é o novo portal de soluções da {{ $css_template ? strtoupper($css_template) : 'Alvo Solutions'}}!
                    </p>
                    <p class="text-justify">
                        Agora todos os sistemas integrados da {{ $css_template ? strtoupper($css_template) : 'Alvo'}} podem ser acessados em um só lugar, de uma forma simples e intuitiva.
                    </p>
                    <p class="text-justify">
                        Os sistemas {{ $css_template ? strtoupper($css_template) : 'Alvo'}} são desenvolvidos pela sua equipe de analistas e desenvolvedores, que possibilita maior agilidade em customizações de sistemas e integrações com vários sistemas de mercado a custos competitivos.
                    </p>
                    <p class="text-justify">
                        Com esta nova Plataforma a {{ $css_template ? strtoupper($css_template) : 'Alvo'}} avança para cada vez mais buscar melhoria contínua, através de uso disciplinado de ferramentas de gestão e uso intensivo da tecnologia no apoio de nosso <em>Core Businness</em> – oferecer soluções para a gestão do <em>Supply Chain</em> de nossos clientes.
                    </p>
                </div>

                @include('layouts._includes._easter')
            </div>
        </div>
    </div>
</div>


@endsection
