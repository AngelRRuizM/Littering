<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Pin;
use App\User;
use App\Location;
use App\ResidueType;
use JavaScript;
use Carbon\Carbon;

class PinController extends Controller
{
    /**
     * Lista los pines.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(sizeof(Auth::user()->locations) == 0){
            session()->flash('info', 'Antes de agregar pines, debes agregar una Localizacion.');
            return redirect(route('user.locations'));
        }

        Carbon::setLocale('es');
        $pins = Pin::where('user_id', auth()->user()->id)->where('collected', false)->with('location')->get()->sortByDesc('updated_at');
        $residue_types = ResidueType::all()->sortBy('name');
        $locations = auth()->user()->locations->sortBy('name');

        JavaScript::put([
            'pins' => $pins->toArray()
        ]);

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
        $validator = Pin::validate($request->all());

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

        session()->flash('message', 'El pin se ha creado con exito.');
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
        $residue_types = ResidueType::all()->sortBy('name');
        $locations = Location::all()->sortBy('name');

        return view('users.pins.edit', compact('pin', 'residue_types', 'locations'));
    }

    /**
     * Muestra el formulario para editar el pin especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function collect(Pin $pin)
    {
        $pin->collected = true;
        $pin->save();

        session()->flash('message', 'El pin se ha marcado como recolectado exitosamente.');
        return redirect( route('user.pins'));
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
        $validator = Pin::validate($request->all());

        if($validator->fails()){
            return redirect()->back()
                ->withInput($request)
                ->withErrors($validator);
        }
        
        $pin->residue_type_id = $request->residue_type_id;
        $pin->location_id = $request->location_id;
        $pin->save();


        session()->flash('message', 'El pin se ha creado exitosamente.');
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
        $pin->delete();

        session()->flash('message', 'El pin se ha eliminado exitosamente.');
        return redirect(route('user.pins'));
    }
}
