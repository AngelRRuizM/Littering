@extends('layouts.master')

@section('content')
        
        <div class="bar background-gray" style="padding-top:30px;">
        @foreach($residue_types as $residue_type)
            <div class="col-md-3 col-sm-3">
                <div class="team-member" data-animate="fadeInUp">
                    <div class="">
                        <div class="image col-md-3">
                            <img src="img/marker{{$residue_type->id}}.png" alt="" class="img-responsive img-circle">
                        </div>
                    </div>
                    <div class="col-md-9 text-left">
                        <h3>{{$residue_type->name}}</h3>
                    </div>
                </div>
                <!-- /.team-member -->
            </div>
        @endforeach
        </div>
        <!-- /.row -->



<div class="row">
    <div class="col-md-12">
        <div id="map" class="col-sm-12" style="height: 700px"></div>
    </div>
</div>

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
                    zIndex: i+1,
                    title: pins[i].location.address
                });
                markers.push(marker);
            }
        }
    
    }
</script>

<!-- Google Maps key -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhWPoSrUkIkNTTV6lkGfZCToBac1M7TZA&callback=initMap"></script>
@endsection