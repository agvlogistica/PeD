@extends('layouts.start')

@section('title', 'Entrar')

@section('content')
<p>O <strong>Alvo<span class="text-warning">+</span></strong> é o novo portal de sistemas da Alvo Solutions!</p>
<p>Entre. E veja-o em ação.</p>
<form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="e-mail" autofocus>

        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password" type="password" class="form-control" name="password" placeholder="senha">

        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> Lembre-me
            </label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary block full-width m-b">
        Entrar
    </button>
    <a class="btn btn-link" href="{{ url('/password/reset') }}">
        Esqueceu sua senha?
    </a>
    <p class="text-muted text-center"><small>Ainda não possui uma conta?</small></p>
    <a class="btn btn-sm btn-white btn-block" href="{{ url('/register') }}">Registre-se</a>
</form>
@endsection
