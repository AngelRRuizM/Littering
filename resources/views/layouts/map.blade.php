@section('scripts')
<script type="text/javascript">
    var map;
    function initMap() {
        var coords = pins.length > 0? new google.maps.LatLng(pins[0].location.lat, pins[0].location.lng): new google.maps.LatLng(19.020638, -98.243254);

        map = new google.maps.Map(document.getElementById('map'), {
            center: coords,
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