<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert; // Importa la clase Alert
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;



class contrasenaController extends Controller
{
    public function NewPassword2()
    {
        return view('profile.cambiarc');
    }

    public function changePassword2(Request $request)
    {
        $request->validate([
            'password_actual' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $user = Auth::user();
        $userPassword = $user->password;

        if (Hash::check($request->password_actual, $userPassword)) {
            $newPass = $request->password;
            $confirmPass = $request->confirm_password;

            if ($newPass == $confirmPass) {
                if (strlen($newPass) >= 6) {
                    $user->password = Hash::make($request->password);
                    $user->save();

                    Alert::success('Clave cambiada', 'La clave fue cambiada correctamente.');
                    return redirect()->back();
                } else {
                    Alert::error('Clave incorrecta', 'Recuerda que la clave debe tener al menos 6 caracteres.');
                    return redirect()->back();
                }
            } else {
                Alert::error('Clave incorrecta', 'Por favor, verifica que las claves coincidan.');
                return redirect()->back();
            }
        } else {
            Alert::error('Clave actual incorrecta', 'La clave actual ingresada no coincide con la contraseña actual.');
            return back()->withErrors(['password_actual' => 'La clave actual no coincide.']);
        }
    }
    

    public function newcontrasena()
    {
        return view('cliente.cambiar');
    }

    public function changecontrasena(Request $request)
    {
        $request->validate([
            'password_actual' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $user = Auth::user();
        $userPassword = $user->password;

        if (Hash::check($request->password_actual, $userPassword)) {
            $newPass = $request->password;
            $confirmPass = $request->confirm_password;

            if ($newPass == $confirmPass) {
                if (strlen($newPass) >= 6) {
                    $user->password = Hash::make($request->password);
                    $user->save();

                    Alert::success('Clave cambiada', 'La clave fue cambiada correctamente.');
                    return redirect()->back();
                } else {
                    Alert::error('Clave incorrecta', 'Recuerda que la clave debe tener al menos 6 caracteres.');
                    return redirect()->back();
                }
            } else {
                Alert::error('Clave incorrecta', 'Por favor, verifica que las claves coincidan.');
                return redirect()->back();
            }
        } else {
            Alert::error('Clave actual incorrecta', 'La clave actual ingresada no coincide con la contraseña actual.');
            return back()->withErrors(['password_actual' => 'La clave actual no coincide.']);
        }
    }
}
