@extends('layouts.start')

@section('title', 'Registre-se')

@section('content')
<p>Registre-se para vê-lo em ação.</p>
<form class="m-t" role="form" method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nome" autofocus>

        @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="e-mail">

        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password" type="password" class="form-control" name="password" placeholder="Senha">

        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme sua Senha">

        @if ($errors->has('password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
        @endif
    </div>

    <button type="submit" class="btn btn-primary block full-width m-b">
        Registrar
    </button>
    <p class="text-muted text-center"><small>Já possui uma conta?</small></p>
    <a class="btn btn-sm btn-white btn-block" href="{{ url('/login') }}">Entrar</a>
</form>
@endsection
