@extends('layouts.master')

@section('content')
<section class="no-mb">
    <div class="jumbotron">

        <div class="dark-mask"></div>

        <div class="container">
            <div class="row mb-small">
                <div class="col-sm-12 text-center">
                    <h1>Littering</h1>
                    <h2>Más Littering para que haya menos <i>litter</i></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-8 mb-small">
                    <img class="img-responsive" src="img/template-mac.png" alt="">
                </div>
                <div class="col-sm-4 mb-small text-center">
                    <p>Nuestro mapa muestra los pines en sus respectivas ubiciones.</p> 
                    <p><a href="/map" class="btn btn-lg btn-warning">Ver mapa</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bar background-gray no-mb padding-big text-center-sm" id="aboutus">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-uppercase">Acerca de nosotros</h2>
                <p class="lead mb-small"></p>
                <p class="mb-small">Littering propone una iniciativa para hacer eficiente la gestión y reciclaje de residuos urbanos, como vidrio, papel y aluminio, al mismo tiempo que promueve la 
                participación ciudadana con el fin de dignificar la labor llevada a cabo por un grupo vulnerable de la población como lo son los recuperadores primarios de materiales reciclables, 
                quienes realizan el oficio de recolectar, seleccionar, recuperar, transformar, comercializar y reutilizar los residuos sólidos, por lo general en condiciones insalubres, expuestos así 
                a enfermedades que ponen en riesgo su salud.</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="img/reciclaje.png" alt="" class="img-responsive">
            </div>
        </div>
    </div>
</section>

<section class="bar background-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading">
                            <h2>Tipos de desechos</h2>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                @foreach($residue_types as $residue_type)
                    <div class="col-md-3 col-sm-3">
                        <div class="team-member" data-animate="fadeInUp">
                            <div class="image">
                                <a href="team-member.html">
                                    <img src="img/{{$residue_type->image}}" alt="" class="img-responsive img-circle">
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
                <h2 class="text-uppercase">Colabora con nosostros</h2>
                <p class="mb-small">Las ciudades no paran de crecer, garantizar que sean sostenibles y ofrezcan a la población las condiciones ideales para el desarrollo de su vida cotidiana, depende 
                de proyectos como Littering. La generación de residuos urbanos en nuestro país ha aumentado significativamente en un 43.8%, pasando de 29.3 a 42.1 millones de toneladas producidas. Es 
                por esto que invitamos a toda la población a que contribuya con nosotros para lograr mejorar la gestión y reutilización de estos residuos. </p>
            </div>
        </div>
    </div>
</section>

<section class="bar background-gray no-mb padding-big text-center-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-uppercase">Ayuda para todos</h2>
                <p class="mb-small">Los grupos sociales en condiciones de desventaja, tienen dificultades para incorporarse al desarrollo para acceder a mejores condiciones de vida. Es por esto, que
                    Littering, buscar brindar a los recuperadores primarios de materiales reciclables, mejores condiciones, para que desempeñen su trabajo en condiciones dignas que no pongan en riesgo su 
                    integridad física y mental. </p>
            </div>
            <div class="col-md-6 text-center">
                <img src="img/basurero.png" alt="" class="img-responsive">
            </div>
        </div>
    </div>
</section>
@endsection