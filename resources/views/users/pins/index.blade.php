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

            <div class="row">
                <h3>Agregar un nuevo pin de residuo</h3>
                
                @if(sizeof(Auth::user()->locations) > 0)
                    <form method="POST" action="{{route('user.pins.store')}}">
                        {{ csrf_field() }}

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="location">Localización</label>
                                <select class="form-control" name="location_id" id="location">
                                    @if(Auth::user()->pins->last() == null)
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}">{{$location->name}}</option>
                                        @endforeach
                                    @else
                                        @foreach($locations as $location)
                                            @if(Auth::user()->pins->last()->location->id == $location->id)
                                                <option value="{{$location->id}}" selected>{{$location->name}}</option>
                                            @else
                                                <option value="{{$location->id}}">{{$location->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="residue_type">Tipo de residuo</label>
                                <select class="form-control" name="residue_type_id" id="residue_type">
                                    @if(Auth::user()->pins->last() == null)
                                        @foreach($residue_types as $residue_type)
                                            <option value="{{$residue_type->id}}">{{$residue_type->name}}</option>
                                        @endforeach
                                    @else
                                        @foreach($residue_types as $residue_type)
                                            @if(Auth::user()->pins->last()->residue_type->id == $residue_type->id)
                                                <option value="{{$residue_type->id}}" selected>{{$residue_type->name}}</option>
                                            @else
                                                <option value="{{$residue_type->id}}">{{$residue_type->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-template-main" style="margin-top:25px;">Agregar</button>
                            </div>
                        </div>
                    </form>
                @else
                    <p class="lead">Aún no tienes localizaciones. Primero agrega una en la sección Mis Localizaciones</p>
                @endif
            </div>

            <div class="row">
                <h3>Pines activos</h3>
                <div class="box">
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
                                                <form class="delete" action="{{ route('user.pins.destroy', ['pin_id' => $pin->id   ]) }}" method="POST">
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
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div id="map" class="col-sm-12" style="height: 500px"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@include('layouts.map')

@section('scripts')
<script>
$(document).ready(function(){
    $('.delete').submit(function(event){
        if(!confirm("¿Estás seguro de que quieres eliminar este pin?")){
            event.preventDefault();
        }
    });
});
</script>
@endsection