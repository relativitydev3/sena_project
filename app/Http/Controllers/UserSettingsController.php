<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; // Necesario
use Illuminate\Support\Facades\DB; // Necesario
use RealRashid\SweetAlert\Facades\Alert;// Importa la clase Alert
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

class UserSettingsController extends Controller
{
    public function NewPassword()
    {
        return view('profile.configure_user_profile');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        $request->validate([
            'name' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:30',
            'apellidos' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:45',
            'documento' => 'nullable|string|max:10|unique:users,documento,' . $userId,
            'telefono' => 'nullable|numeric|digits:10',
            'direccion' => 'nullable|max:50',
            'email' => 'required|email|unique:users,email,' . $userId,
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El campo nombre solo debe contener letras.',
            'name.max' => 'El campo nombre no debe tener más de 30 caracteres.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.regex' => 'El campo apellidos solo debe contener letras.',
            'apellidos.max' => 'El campo apellidos no debe tener más de 45 caracteres.',
            'documento.min' => 'El documento debe ser valido.',
            'documento.unique' => 'El documento ingresado ya está en uso.',
            'documento.regex' => 'El campo documento solo puede contener números.',
            'telefono.numeric' => 'El campo teléfono debe contener solo números.',
            'telefono.digits' => 'El campo teléfono debe tener exactamente 10 dígitos.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.max' => 'El campo email no debe tener más de 60 caracteres.',
            'email.unique' => 'El email ingresado ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.same' => 'El campo contraseña y confirmación de contraseña deben ser iguales.',
            'password.max' => 'El campo contraseña no debe tener más de 15 caracteres.',
            'roles.required' => 'Debe seleccionar un rol.'
        ]);

        $user->name = $request->name;
        $user->apellidos = $request->apellidos;
        $user->documento = $request->documento;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->email = $request->email;

        $user->save();

        Session::flash('sweet-alert', [
            'type' => 'success',
            'title' => 'Datos actualizados',
            'text' => 'Los datos de tu perfil fueron actualizados correctamente.'
        ]);

        return redirect()->back()->with('success', 'Los datos del perfil se han actualizado correctamente.');
    }

    public function newperfil()
    {
        return view('cliente.perfil');
    }

    public function changeperfil(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
    
        $request->validate([
            'name' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:30',
            'apellidos' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|max:45',
            'documento' => 'required|string|max:10|unique:users,documento,' . $userId,
            'telefono' => 'required|numeric|digits:10',
            'direccion' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $userId,
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El campo nombre solo debe contener letras.',
            'name.max' => 'El campo nombre no debe tener más de 30 caracteres.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.regex' => 'El campo apellidos solo debe contener letras.',
            'apellidos.max' => 'El campo apellidos no debe tener más de 45 caracteres.',
            'documento.min' => 'El documento debe ser valido.',
            'documento.unique' => 'El documento ingresado ya está en uso.',
            'documento.regex' => 'El campo documento solo puede contener números.',
            'telefono.numeric' => 'El campo teléfono debe contener solo números.',
            'telefono.digits' => 'El campo teléfono debe tener exactamente 10 dígitos.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.max' => 'El campo email no debe tener más de 60 caracteres.',
            'email.unique' => 'El email ingresado ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.same' => 'El campo contraseña y confirmación de contraseña deben ser iguales.',
            'password.max' => 'El campo contraseña no debe tener más de 15 caracteres.',
            'roles.required' => 'Debe seleccionar un rol.'
        ]);
    
        $user->name = $request->name;
        $user->apellidos = $request->apellidos;
        $user->documento = $request->documento;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->email = $request->email;
    
        $user->save();

        Session::flash('sweet-alert', [
            'type' => 'success',
            'title' => 'Datos actualizados',
            'text' => 'Los datos de tu perfil fueron actualizados correctamente.'
        ]);
    
        return redirect()->back()->with('success', 'Los datos del perfil se han actualizado correctamente.');
    }
}


