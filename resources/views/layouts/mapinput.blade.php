<div>
    <div id="map" class="col-sm-12" style="height: 500px"></div>
    <script type="text/javascript">
        var map;
        var coords;
        var marker;
        function initMap() {
            coords = new google.maps.LatLng(19.020638, -98.243254);
            map = new google.maps.Map(document.getElementById('map'), {
                center: coords,
                zoom: 15
            });

            marker = new google.maps.Marker({
                position: coords,
                map: map,
                draggable:true,
                title:"Arrástrame!"
            });
        }
    </script>
</div>