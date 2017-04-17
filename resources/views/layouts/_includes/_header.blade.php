<div class="row border-bottom">
    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form class="navbar-form-custom" action="{{ route('empresa.select') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="input-group">
                        <select class="form-control" name="empresa">
                            <option value="">Selecione a Empresa</option>
                            @foreach ($select_empresas as $empresa)
                            <option value="{{ $empresa->id }}" {{ Auth::user()->empresa_id == $empresa->id ? 'selected' : '' }}>{{ $empresa->nome }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
            </li>
            <li>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <strong class="font-bold">{{ Auth::user()->name }} <b class="caret"></b></strong>
                </a>
                <ul class="dropdown-menu animated fadeInDown m-t-xs">
                    <li><a href="{{ route('user.profile') }}">Perfil</a></li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Sair
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>


                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    {!! Config::get('languages')[App::getLocale()] !!} <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInDown m-t-xs">
                    @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                    <li>
                        <a href="{{ route('lang.switch', $lang) }}">{!! $language !!}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </li>
        </ul>


    </nav>
</div>
@yield('menu_title')
