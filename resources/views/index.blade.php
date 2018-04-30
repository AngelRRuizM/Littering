@extends('layouts.master')

@section('content')

<div class="home-carousel">

    <div class="dark-mask"></div>

    <div class="container">
        <div class="homepage owl-carousel">
            <div class="item">
                <div class="row">
                    <div class="col-sm-7 text-center">
                        <img class="img-responsive" src="{{asset('img/logo-index.png')}}" alt="">
                    </div>

                    <div class="col-sm-5">
                        <h2>Littering</h2>
                        <h3>Más Littering para que haya menos <i>litter</i></h3>
                        <ul class="list-style-none">
                            <li>Más reciclaje.</li>
                            <li>Menos desechos.</li>
                            <li>Mejores condiciones de trabajo.</li>
                            <li>MAyores ingresos.</li>
                        </ul>
                        <a href="/map"><button class="btn btn-template-main">Ir a mapa</button></a>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.project owl-slider -->
    </div>
</div>

<section class="bar background-gray no-mb padding-big text-center-sm" id="aboutus">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-uppercase">¿Qué es Littering?</h2>
                <p class="lead mb-small">Littering propone una alternativa para incrementar la cantidad de residuos reciclados en las ciudades.</p>
                <p class="lead mb-small">Al mismo tiempo busca mejorar las condiciones de trabajo de los recolectores de materiales reciclables, cuya activiad económica no recibe la importancia que merece.</p>
                <p class="lead mb-small">Facilita la participación ciudadana, asegura que nuestros residuos se reciclen y además ayuda a nuestros pepenadores.</p>
            </div>
            <div class="col-md-6">
                <img src="img/reciclaje.png" style="margin:auto;" alt="" class="img-responsive">
            </div>
        </div>
    </div>
</section>

<section class="bar no-mb color-white padding-big text-center-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <img src="{{asset('img/personajes.png')}}" alt="" class="img-responsive">
            </div>
            <div class="col-md-6">
                <h2 class="text-uppercase">¿Cómo funciona?</h2>
                <h3 class="lead mb-small">Sigue estos pasos:</h3>
                <p class="lead mb-small">
                    1. Regístrate o inicia sesión.</br>
                    2. Indica el lugar donde depositarás los residuos reciclables.</br>
                    3. Listo, un marcador le en el mapa le indicará al recolector que en ese lugar hay material que puede recoger.</br>
                    4. Puedes marcar que el residuo que depositaste ha sdo recolectado.
                </p>
                <p class="lead mb-small">Recuerda que los residuos deben estar debidamente separados en un contenedor o bolsa.</p>
            </div>
        </div>
    </div>
</section>

<section class="bar background-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-uppercase">¿Qué residuos puedo reciclar?</h2>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                @foreach($residue_types as $residue_type)
                    <div class="col-md-3 col-sm-3">
                        <div class="team-member" data-animate="fadeInUp">
                            <div class="image">
                                <a href="team-member.html">
                                    <img src="img/{{$residue_type->image}}" alt="" class="img-responsive img-circle" style="margin:auto;">
                                </a>
                            </div>
                            <h3><a href="team-member.html">{{$residue_type->name}}</a></h3>
                            <p class="role">{{$residue_type->description}}</p>
                        </div>
                        <!-- /.team-member -->
                    </div>
                @endforeach
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </section>

<section class="bar no-mb color-white padding-big text-center-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <img src="img/mundo.png" alt="" class="img-responsive">
            </div>
            <div class="col-md-6">
                <h2 class="text-uppercase">¿A quienes ayudamos?</h2>
                <p class="mb-small">Las ciudades no paran de crecer, garantizar que sean sostenibles y ofrezcan a la población las condiciones ideales para el desarrollo de su vida cotidiana, depende 
                de proyectos como Littering. La generación de residuos urbanos en nuestro país ha aumentado significativamente en un 43.8%, pasando de 29.3 a 42.1 millones de toneladas producidas. Es 
                por esto que invitamos a toda la población a que contribuya con nosotros para lograr mejorar la gestión y reutilización de estos residuos. </p>
            </div>
        </div>
    </div>
</section>
@endsection