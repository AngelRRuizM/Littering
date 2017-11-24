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
        <div class="col-md-12">
            @include('layouts.message')
            <h2>Pines activos</h2>
            
            @if(sizeof($pins) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Localización</th>
                                <th>Tipo de residuo</th>
                                <th>Último cambio</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pins as $pin)
                                <tr>
                                    <td>{{$pin->location->name}}</td>
                                    <td>{{$pin->residue_type->name}}</td>
                                    <td>{{$pin->updated_at->diffForHumans()}}</td>
                                    <td><a href="{{ route('user.pins.collect', ['pin_id' => $pin->id]) }}" class="btn btn-success btn-sm">Recolectar</a></td>
                                    <td><a href="{{ route('user.pins.edit', ['pin_id' => $pin->id]) }}" class="btn btn-info btn-sm">Editar</a></td>
                                    <td>
                                        <form action="{{ route('user.pins.destroy', ['pin_id' => $pin->id   ]) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>    
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            @else
                <p>No tienes pines activos.</p>
            @endif

            <div class="row">
                <h4>Agregar un nuevo pin</h4>
                
                @if(sizeof(Auth::user()->locations) > 0)
                    <form method="POST" action="{{route('user.pins.store')}}">
                        {{ csrf_field() }}

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="location">Localización</label>
                                <select name="location_id" id="location">
                                    @foreach($locations as $location)
                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="residue_type">Tipo de residuo</label>
                                <select name="residue_type_id" id="residue_type">
                                    @foreach($residue_types as $residue_type)
                                        <option value="{{$residue_type->id}}">{{$residue_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>
                    </form>
                @else
                    <p>Aún no tienes localizaciones. Primero agrega una en la sección Mis Localizaciones</p>
                @endif
            </div>

        </div>

        <div class="col-md-12">
            <div id="map" class="col-sm-12" style="height: 600px"></div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script type="text/javascript">
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 19.020638, lng: -98.243254},
            zoom: 15
        });
        
        var markers = [];
        for(var i=0; i < pins.length; i++){
            if(!pins[i].collected){
                var image = '/img/marker' + pins[i].residue_type_id + '.png';
                var coords = new google.maps.LatLng(pins[i].location.lat, pins[i].location.lng);
                var marker = new google.maps.Marker({
                    position : coords,  
                    map : map,
                    icon : image,
                    zIndex: i+1
                });
                markers.push(marker);
            }
        }
    
    }
</script>

<!-- Google Maps key -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhWPoSrUkIkNTTV6lkGfZCToBac1M7TZA&callback=initMap"></script>
@endsection