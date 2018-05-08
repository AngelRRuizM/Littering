
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
                    <div id="map" class="col-sm-12" style="height: 500px"></div>
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

@include('layouts.mapinput')