<div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">
    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="/">
                    <img src="{!! asset('img/logo.png') !!}" alt="Universal logo" class="hidden-xs hidden-sm">
                    <img src="{!! asset('img/logo-small.png') !!}" alt="Universal logo" class="visible-xs visible-sm"><span class="sr-only">Ir a página de inicio</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/" >Inicio</a></li>
                    <li><a href="/#aboutus">Acerca de nosotros</a></li>
                    @if(Auth::check())
                        <li><a href="/usuario/pines" >Pines</a></li>
                        <li><a href="/usuario/localizaciones" >Mis localizaciones</a></li>
                    @endif
                </ul>

            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>