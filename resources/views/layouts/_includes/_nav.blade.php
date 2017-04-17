<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="profile-element">
                    <a href="{{ url('/') }}">
                        <img src="/img/Logo{{ $css_template ? '_'.$css_template : ''}}.png" alt="" class="img-responsive center-block" style="height: 120px"/>
                    </a>
                </div>
                <div class="logo-element">
                    {{ $css_template ? strtoupper($css_template) : 'Alvo'}}
                </div>
            </li>
            {!! $menu_lateral !!}

        </ul>

    </div>
</nav>
