@extends('layouts.master')

@section('heading')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1>Mis pines</h1>
            </div>
        </div>
    </div>
</div>

@endsection


@section('content')

    <section class="bar background-white no-mb">
        <div class="container">
            <div class="row">
                        <h2>Pines actuales</h2>
                        @include('layouts.map')
                    </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <h2>Localizaciones</h2>
                        </div>
                        <div class="col-md-9">
                            <a href="/usuario/localizaciones/crear" class="btn btn-primary text-center">Agregar localización</a>
                        </div>
                    </div>
                    @foreach($locations as $location)
                        <div class="col-sm-3">
                                <div class="box-simple box-white same-height">
                                    <h3>{{$location->name}}</h3>
                                    <p>{{$location->address}}.</p>
                                    <form action="localizaciones/{{ $location->id }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                                    </form>
                                    <a href="{{ URL::route('user.locations.edit', ['location_id' => $location->id   ]) }}"><button type="button" class="btn btn-xs btn-info">Editar</button></a>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">

                    <div class="row">
                    <h4>Agregar un nuevo pin</h4>
                        <form method="POST" action="/usuario/pines">
                            {{ csrf_field() }}

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="location">Localización</label>
                                    <select name="location_id" id="location">
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}">{{$location->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="residue_type">Tipo de residuo</label>
                                    <select name="residue_type_id" id="residue_type">
                                        @foreach($residue_types as $residue_type)
                                            <option value="{{$residue_type->id}}">{{$residue_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </div>
                            </div>
                        </form>
                </div>
                </div>
                </div>
            </div>
        </div>
    </section>

@endsection