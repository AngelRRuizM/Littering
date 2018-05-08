@extends('layouts.master')

@section('content')
    
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <h2 class="text-uppercase">Editar ubicación</h2>
                    <p>Puedes escribir la dirección y se mostrará inmediatamente en el mapa.</p>
                </div>
            </div>
            <div class="col-md-4">
                <form action="{{ URL::route('user.locations.update', ['location_id' => $location->id   ]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="name">Nombre de la ubicación</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$location->name}}" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{$location->address}}" required>
                    </div>

                    <input type="hidden" class="form-control" id="lat" name="lat" value="{{$location->lat}}">
                    <input type="hidden" class="form-control" id="lng" name="lng" value="{{$location->lng}}">
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-template-main" onclick="setCoords();">Aceptar</button>
                    </div>
                    
                    <hr>
                </form>
                @include('layouts.errors')
            </div>

            <div class="col-md-8">
                <div class="row">
                    <p>Marca tu ubicación</p>
                    <div id="map" class="col-sm-12" style="height: 500px"></div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection

@include('layouts.mapinput')