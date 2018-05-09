<?php

namespace App\Http\Controllers;

use App\Location;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use JavaScript;

class LocationController extends Controller
{
    /**
     * Lista las localizaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = auth()->user()->locations;
        
        return view('users.locations.index', compact('locations'));
    }

    /**
     * Muestra el formulario para crear una nueva localización
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.locations.create');
    }

    /**
     * Guarda una localización nueva
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //verifica que los datos estén presentes y que cuenten con la longitud adecuada
        $validator = Location::validate($request->all());

        //regresa a la página anterior si hubo algún error en los datos recibidos.
        if($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        //crea y guarda el nuevo dato
        $location = Location::create([
            'lat' => $request->lat,
            'lng' => $request->lng,
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => auth()->user()->id,
        ]);

        session()->flash('message', 'La nueva localización ha sido guardada exitosamente.');
        return redirect( route('user.locations') );
    }

    /**
     * Muestra el formulario para editar una localizacción
     *
     * @param  Location $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        JavaScript::put([
            'loc' => $location
        ]);

        return view('users.locations.edit', compact('location'));
    }

    /**
     * Actualiza una localización con cambios realizados a sus datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //verifica que los datos estén presentes y que cuenten con la longitud adecuada
        $validator = Location::validate($request->all());

        //regresa a la página anterior si hubo algún error en los datos recibidos.
        if($validator->fails()){
            return redirect()->back()->withInput($request)->withErrors($validator);
        }
        //guarda el nuevo dato

        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->name = $request->name;
        $location->address = $request->address;
        $location->save();

        session()->flash('message', 'La nueva localización ha sido guardada correctamente.');
        return redirect(route('user.locations'));

    }

    /**
     * Elimina la localización especificada del almacenamiento
     *
     * @param  Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();
        
        session()->flash('message', 'La localización se ha eliminado exitosamente.');
        return redirect(route('user.locations'));
    }
}
