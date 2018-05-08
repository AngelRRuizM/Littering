
<div class="row">
    <h3>Agregar ubicación</h3>
    <div class="col-md-12 box">
        <form action="{{ route('user.locations.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" class="form-control" id="lat" name="lat">
            <input type="hidden" class="form-control" id="lng" name="lng">
            <input type="hidden" class="form-control" id="address" name="address">

            <div class="col-md-12">
                <div class="row">
                    
                    <p>Arrastra el pin a la localización deseada.</p>
                    @include('layouts.mapinput')
                </div>
                <br>
            </div>

            <div class="form-group col-md-6">
                <label for="name">Nombre de la ubicación</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
    
            <div class="form-group pull-right">
                <button type="submit" class="btn btn-template-main" id="submit" onclick="setCoords()" style="margin-top:25px;">Agregar</button>
            </div>
        </form>
        @include('layouts.errors')
    </div>
</div>

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
        origin.position = results[0].geometry.location;      
        marker.setPosition(results[0].geometry.location);
    } else {
        alert('Geocode was not successful for the following reason: ' + status);
    }
    });
}

function setCoords(){
    document.getElementById('lat').value = origin.getPosition().lat();
    document.getElementById('lng').value = origin.getPosition().lng();
}

function toggleDisabled() {
    document.getElementById('submit').disabled = !document.getElementById('submit').disabled;
}
</script>

<!-- Google Maps key -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhWPoSrUkIkNTTV6lkGfZCToBac1M7TZA&callback=initMap"></script>  
@endsection