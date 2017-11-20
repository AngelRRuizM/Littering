<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Pin;
use App\User;
use App\Location;
use App\ResidueType;

class PinController extends Controller
{
    /**
     * Lista los pines.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pins = Pin::all();
        $residue_types = ResidueType::all()->sortBy('name');
        $locations = Location::all()->sortBy('name');

        return view('users.pins.index', compact('pins', 'residue_types', 'locations'));
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     //
    }

    /**
     * Almacena un pin nuevo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'residue_type_id' => 'required|numeric',
            'location_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return redirect()->back()
                ->withInput($request)
                ->withErrors($validator);
        }
        
        $pin = new Pin;
        $pin->residue_type_id = $request->residue_type_id;
        $pin->location_id = $request->location_id;
        $pin->user_id = auth()->user()->id;
        $pin->save();

        session()->flash('message', 'El pin nuevo se ha creado con exito.');
        return redirect(route('user.pins'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pin $pin)
    {
        //
    }

    /**
     * Muestra el formulario para editar el pin especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pin $pin)
    {
        if($pin == null){
            $errors = ['No se ha encontrado el id especificado.'];
            return redirect()->back()->withErrors($errors);
        }

        $residue_types = ResidueType::all()->sortBy('name');
        $locations = Location::all()->sortBy('name');

        return view('users.pins.edit', compact('pin', 'residue_types', 'locations'));
    }

    /**
     * Actualiza la información correspondiente a un pin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pin $pin)
    {
        if($pin == null){
            $errors = ['No se ha encontrado el id especificado.'];
            return redirect()->back()->withErrors($errors);
        }

        $validator = Validator::make($request->all(), [
            'residue_type_id' => 'required|numeric',
            'location_id' => 'required|numeric'
        ]);

        if($validator->fails()){
            return redirect()->back()
                ->withInput($request)
                ->withErrors($validator);
        }
        
        $pin->residue_type_id = $request->residue_type_id;
        $pin->location_id = $request->location_id;
        $pin->save();


        session()->flash('message', 'El pin nuevo se ha creado con exito.');
        return redirect(route('user.pins'));
    }

    /**
     * Elimina el pin especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pin $pin)
    {
        if($pin == null){
            $errors = ['No se ha encontrado el id especificado.'];
            return redirect()->back()->withErrors($errors);
        }

        $pin->delete();
        return redirect(route('user.pins'));
    }
}
