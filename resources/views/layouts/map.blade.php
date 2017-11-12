<div>
    <div id="map" class="col-sm-12" style="height: 650px"></div>
    <script type="text/javascript">
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 19.020638, lng: -98.243254},
                zoom: 15
            });
            
            var markers = [];
            for(var i=0; i < pins.length; i++){
                var image = '/img/marker' + pins[i].residue_id + '.png';
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
    </script>
</div>