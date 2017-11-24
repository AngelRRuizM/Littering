@extends('layouts.master')

@section('heading')
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1>Mis localizaciones</h1>
            </div>
        </div>
    </div>
</div>

@endsection

@section('content')
<div id="content">
    <div class="container">
        <div class="row">

            <div class="col-md-12" id="customer-orders">
                @include('layouts.message')
                <p class="text-muted lead"><a href="{{ URL::route('user.locations.create') }}" class="btn btn-primary">Agregar localización</a></p>
                
                <div class="box">
                     @if(sizeof(Auth::user()->locations) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($locations as $location)
                                        <tr>
                                            <td>{{$location->name}}</td>
                                            <td>{{$location->address}}</td>
                                            <td><a href="{{ route('user.locations.edit', ['location_id' => $location->id]) }}" class="btn btn-info btn-sm">Editar</a></td>
                                            <td>
                                                <form action="{{route('user.locations.destroy', ['location_id' => $location->id]) }}" method="POST">
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
                        <p>Aún no tienes localizaciones. Agrega una.</p>
                    @endif

                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-12 -->
        </div>
    </div>
</div>

@endsection