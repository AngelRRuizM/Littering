<?php

namespace App\Http\Controllers;

use App\Location;
use App\User;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Lista las localizaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();
        
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
        $validator = Validator::make($request->all(), [
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'name' => 'required|max:50',
            'address' => 'required|max:80',
            'user_id' => 'required|Integer',
        ]);

        //regresa a la página anterior si hubo algún error en los datos recibidos.
        if($validator->fails()){
            return redirect()->back()
                ->withInput($request)
                ->withErrors($validator);
        }
        //crea y guarda el nuevo dato
        $location = new Location;
        $lat = $request->lat;
        $lng = $request->lng;
        $name = $request->name;
        $address = $request->address;
        $user_id = $request->user_id;
        $location->save();

        session()->flash('message', 'La nueva localización ha sido guardada correctamente.');
        return redirect('/usuario/localizaciones');
    }

    /**
     * Muestra el formulario para editar una localizacción
     *
     * @param  Location $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        if($location==null){
            $errors = ['No se ha encontrado el id especificado'];
            return redirect()->back()->withErrors($errors);
        }

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
        if($location==null){
            $errors = ['No se ha encontrado el id especificado'];
            return redirect()->back()->withErrors($errors);
        }

        //verifica que los datos estén presentes y que cuenten con la longitud adecuada
        $validator = Validator::make($request->all(), [
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'name' => 'required|max:50',
            'address' => 'required|max:80',
            'user_id' => 'required|Integer',
        ]);

        //regresa a la página anterior si hubo algún error en los datos recibidos.
        if($validator->fails()){
            return redirect()->back()
                ->withInput($request)
                ->withErrors($validator);
        }
        //guarda el nuevo dato

        $lat = $request->lat;
        $lng = $request->lng;
        $name = $request->name;
        $address = $request->address;
        $user_id = $request->user_id;
        $location->save();

        session()->flash('message', 'La nueva localización ha sido guardada correctamente.');
        return redirect('/usuario/localizaciones');

    }

    /**
     * Elimina la localización especificada del almacenamiento
     *
     * @param  Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        if($location==null){
            $errors = ['No se ha encontrado el id especificado'];
            return redirect()->back()->withErrors($errors);
        }

        $location->delete();
        return redirect('usuario/localizaciones');
    }
}
