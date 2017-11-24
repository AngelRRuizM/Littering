@extends('layouts.master')

@section('content')
<section class="bar background-white no-mb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box-simple box-white same-height">
                    <div class="row">
                        <h2>{{ auth()->user()->name }}</h2>
                        <h3>E-mail: {{ auth()->user()->email }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <h2>Logros</h2>
            </div>
            <div class="row">
                <div class="box-simple box-white same-height">
                    <p>Pronto habrá logros para recompensar tu esfuerzo, ¡espéralos!</p>
                </div>
            </div>
        </div>
        
    </div>
</section>

@endsection