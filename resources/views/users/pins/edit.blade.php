@extends('layouts.master')

@section('content')
    
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <h2 class="text-uppercase">Editar residuo</h2>
                </div>
            </div>
            <form method="POST" action="{{ action('PinController@update', ['pin_id' => $pin->id]) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="location">Localización</label>
                        <select name="location_id" id="location">
                            @foreach($locations as $location)
                                @if($pin->location->id == $location->id)
                                    <option value="{{$location->id}}" selected>{{$location->name}}</option>
                                @else
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="residue_type">Tipo de residuo</label>
                        <select name="residue_type_id" id="residue_type">
                            @foreach($residue_types as $residue_type)
                                @if($pin->residue_type->id == $residue_type->id)
                                    <option value="{{$residue_type->id}}" selected>{{$residue_type->name}}</option>
                                @else
                                    <option value="{{$residue_type->id}}">{{$residue_type->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection