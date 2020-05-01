@extends('admin.layouts.auth')

@section('content')
    <div class="card">
        <div class="header">
            <p class="lead">Ingrese a su cuenta</p>
        </div>
        <div class="body">
            <form class="form-auth-small" method="POST" action="{{ route('admin.login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="signin-email" class="control-label sr-only">Email</label>
                    <input type="email"
                           class="form-control {{ $errors->has('email') ? ' parsley-error' : '' }}"
                           name="email" id="signin-email"
                           placeholder="E-mail" value="{{ old('email') }}"
                           required>
                    @if ($errors->has('email'))
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required">{{ $errors->first('email') }}</li>
                        </ul>
                    @endif
                </div>
                <div class="form-group">
                    <label for="signin-password" class="control-label sr-only">Contraseña</label>
                    <input type="password"
                           class="form-control {{ $errors->has('password') ? ' parsley-error' : '' }}"
                           name="password" id="signin-password"
                           placeholder="Contraseña"
                           required>
                    @if ($errors->has('password'))
                        <ul class="parsley-errors-list filled">
                            <li class="parsley-required">{{ $errors->first('password') }}</li>
                        </ul>
                    @endif
                </div>
                <div class="form-group clearfix">
                    <label class="fancy-checkbox element-left">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Recuérdame</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">INICIAR SESIÓN</button>
                <div class="bottom">
                                <span class="helper-text m-b-10"><i class="fa fa-lock"></i>
                                    <a href="#" onclick="return false;">¿Olvido su contraseña?</a></span>
                    <span>¿No tienes una cuenta? <a href="#" onclick="return false;">Registrate</a></span>
                </div>
            </form>
        </div>
    </div>
@endsection
