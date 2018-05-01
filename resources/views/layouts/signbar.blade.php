<div id="top">
    <div class="container">
        <div class="row">
            <div class="col-xs-5 contact">
                <p class="hidden-sm hidden-xs"></p>
                <p class="hidden-md hidden-lg"><a href="#" data-animate-hover="pulse"><i class="fa fa-phone"></i></a>  <a href="#" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                </p>
            </div>
            <div class="col-xs-7">
                <div class="social">
                    <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                </div>

                @if(Auth::check())
                    <div class="login">
                        <a href="/usuario"><i class="fa fa-user"></i> <span class="hidden-xs text-uppercase">{{ Auth::user()->name }}</span></a>
                        <a id="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-in"></i>Cerrar sesión</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                @else
                    <div class="login">
                        <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> <span class="hidden-xs text-uppercase">Iniciar sesión</span></a>
                        <a href="{{ route('register') }}"><i class="fa fa-user"></i> <span class="hidden-xs text-uppercase">Registrarse</span></a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>