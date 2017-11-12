@extends('layouts.master')

@section('content')
        
        <div class="bar background-gray">
        @foreach($residues as $residue)
            <div class="col-md-3 col-sm-3">
                <div class="team-member" data-animate="fadeInUp">
                    <div class="">
                        <div class="image col-md-3">
                            <img src="img/marker{{$residue->id}}.png" alt="" class="img-responsive img-circle">
                        </div>
                    </div>
                    <div class="col-md-9 text-left">
                        <h3>{{$residue->name}}</h3>
                    </div>
                </div>
                <!-- /.team-member -->
            </div>
        @endforeach
        </div>
        <!-- /.row -->



<div class="row">
    <div class="col-md-12">
        @include('layouts.map')
    </div>
</div>

@endsection