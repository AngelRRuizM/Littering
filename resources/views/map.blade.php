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

@include('layouts.map')