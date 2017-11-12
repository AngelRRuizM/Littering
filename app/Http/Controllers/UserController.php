<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    
    /**
     * Muetra el perfil del ususario con todos sus atributos guardados en la base excepto la contraseña
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if($user==null){
            $errors = ['No se ha encontrado el ususario especificado'];
            return redirect()->back()->withErrors($errors);
        }
        return view('users.show');
    }

    /**
     * Muestra el formulario para editar ususario
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user==null){
            $errors = ['No se ha encontrado el id especificado'];
            return redirect()->back()->withErrors($errors);
        }

        return view('users.edit');
    }

    /**
     * Actualiza la base de datos con la informacion dada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($user==null){
            $errors = ['No se ha encontrado el usuario especificado'];
            return redirect()->back()->withErrors($errors);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email'=> 'required|max:250|email',
        ]);

        $userEmail=User::all()->where('email', $request->email);

        if($validator->fails()){
            return redirect()->back()->withInput($request)->withErrors($validator);
        }
        else{
            if($userEmail!=null){
                $errors = ['Ese cuenta de correo ya está asociada a otor usuario por favor elija otra'];
                return redirect()->back()->withInput($request)->withErrors($errors);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        session()->flash('message', 'Los cambios se han guardado con exito');
        return redirect('/');
    }

    /**
     * Cambia el valor de activa del usuario seleccionado a falso, indicanto que esta cuenta ya no existe.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user==null){
            $errors = ['No se ha encontrado el usuario especificado'];
            return redirect()->back()->withErrors($errors);
        }

        $user->active = false;
        $user->save();
        Auth::logout();

        session()->flash('message', 'El usuario ha sido eliminado');
        return redirect('/home');
    }
}
