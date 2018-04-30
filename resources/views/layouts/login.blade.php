<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
    <div class="modal-dialog modal-sm">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="Login">Inicia sesión</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group col-md-10 col-md-offset-1">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group col-md-10 col-md-offset-1">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>
                    
                            <div class="form-group">
                                <div class="col-md-6 col-md-10 col-md-offset-1">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuérdame
                                        </label>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button class="btn btn-template-main">Iniciar sesión</button>
                                </div>
                                <div class="col-md-10 col-md-offset-1">    
                                    <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvidaste la contraseña?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <p></br></p>
                    <p class="text-center text-muted">¿Aún no tienes una cuenta?</p>
                    <p class="text-center text-muted"><a href="/registro"><strong>Regístrate ahora</strong></a></p>
            </div>
        </div>
    </div>
</div>