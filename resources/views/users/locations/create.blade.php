@extends('layouts.master')

@section('content')
    
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <h2 class="text-uppercase">Agregar ubicación</h2>
                    <p>Puedes escribir la dirección y se mostrará inmediatamente en el mapa.</p>
                </div>
            </div>
            <div class="col-md-12">
                <form action="{{ route('user.locations.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group col-md-5">
                        <label for="name">Nombre de la ubicación</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" onchange="setOrigin()" required>
                    </div>
                    <input type="hidden" class="form-control" id="lat" name="lat">
                    <input type="hidden" class="form-control" id="lng" name="lng">
                    <div class="text-center col-md-2">
                        <button type="submit" class="btn btn-template-main" onclick="setCoords()">Agregar</button>
                        <script type="text/javascript">
                        </script>
                    </div>
                    <hr>
                </form>
                @include('layouts.errors')
            </div>

            <div class="col-md-12">
                <div class="row">
                    <p>Marca tu ubicación</p>
                    @include('layouts.mapinput')
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
var map;
var origin;
var geocoder;

function initMap() {
    geocoder = new google.maps.Geocoder;

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 19.020638, lng: -98.243254},
        zoom: 14
    });

    origin = new google.maps.Marker({
        position: {lat: 19.020638, lng: -98.243254},
        map: map,
        icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
        draggable:true,
        title:"Localización",
        zIndex: 2,
    });
    geocodeLatLng(origin, 'address');

    origin.addListener('dragend', function(){
        geocodeLatLng(origin, 'address');    
    });
}

function geocodeLatLng(marker, input_id) {
    var latlng = {lat: marker.getPosition().lat(), lng: marker.getPosition().lng()};
    geocoder.geocode({'location': latlng}, function(results, status) {
        if (status === 'OK') {
            if (results[1]) {
                document.getElementById(input_id).value = results[1].formatted_address;
            } else {
                window.alert('No results found');
            }
        }
        else {
            window.alert('Geocoder failed due to: ' + status);
        }
    });
}

function setOrigin(){
    geocodeAddress('address', origin);
    var latlng =  {lat: origin.getPosition().lat(), lng: origin.getPosition().lng()}
    map.setCenter(latlng);
}

function geocodeAddress(input_id, marker) {
    var address = document.getElementById(input_id).value;
    geocoder.geocode({'address': address}, function(results, status) {
    if (status === 'OK') {
        marker.setPosition(results[0].geometry.location);
    } else {
        alert('Geocode was not successful for the following reason: ' + status);
    }
    });
}

function setCoords(){
    document.getElementById('lat').value = origin.getPosition().lat();
    document.getElementById('lng').value = origin.getPosition().lng();
};
</script>

<!-- Google Maps key -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhWPoSrUkIkNTTV6lkGfZCToBac1M7TZA&callback=initMap"></script>  
@endsection