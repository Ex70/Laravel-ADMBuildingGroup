@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="../../"><b>Grupo</b> ADM</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">S&oacute;lo est&aacute;s a un paso de tu nueva contrase&ntilde;a, recupera tu contrase&ntilde;a ahora.</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo Electr&oacute;nico" required autocomplete="email" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Enviar enlace de restablecimiento</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection