@extends('layouts.start')

@section('title', 'Esqueci minha senha')

<!-- Main Content -->
@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<form class="m-t" role="form" method="POST" action="{{ url('/password/email') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="e-mail">

        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

    <button type="submit" class="btn btn-primary block full-width m-b">
        Enviar link para redefinir senha
    </button>
</form>
@endsection
