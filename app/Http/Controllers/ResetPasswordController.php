<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException; 
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
use \stdClass;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\DB; // Importa DB desde Facades
use Illuminate\Support\Facades\Mail; // Importa Mail desde Facades
use Illuminate\Support\Str; 
use App\Mail\RecuperarContrasena;


class ResetPasswordController extends Controller
{

    public function recuperarContrasena(Request $request)
    {
        // Validar la entrada del usuario
        $request->validate([
            'email' => 'required|email',
        ]);

        // Obtener el correo electrónico ingresado por el usuario
        $email = $request->input('email');

        // Verificar si el correo electrónico existe en la tabla users
        $usuario = DB::table('users')->where('email', $email)->first();

        if (!$usuario) {
            // Si el correo electrónico no existe, retornar un mensaje de error
            return response()->json(['message' => 'Correo electrónico no encontrado'], 404);
        }

        // Generar un código aleatorio de 5 dígitos
        $codigo = Str::random(5);

        // Guardar el código en la tabla password_resets
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => $codigo, 'created_at' => now()]
        );

        // Enviar el código por correo electrónico
        Mail::to($email)->send(new RecuperarContrasena($codigo));

        // Retornar una respuesta exitosa si todo fue exitoso
        return response()->json(['message' => 'Se ha enviado un código de recuperación de contraseña por correo electrónico.']);
    }


    public function verificarCodigo(Request $request)
    {
        // Validar la entrada del usuario
        $request->validate([
            'codigo' => 'required|string|size:5',
        ]);

        $codigo = $request->input('codigo');

        // Verificar si el código existe en la tabla password_resets
        $resetInfo = DB::table('password_resets')->where('token', $codigo)->first();

        

        // El código es válido, ahora puedes permitir al usuario configurar una nueva contraseña
        // El correo electrónico asociado al código se encuentra en $resetInfo->email

        return response()->json(['message' => 'Código válido, puede configurar una nueva contraseña']);
    }


    public function cambiarContrasena(Request $request)
    {
        // Validar la entrada del usuario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed', // Debes tener un campo de confirmación en tu formulario
        ]);
    
        $email = $request->input('email'); // Obtener el correo electrónico desde la solicitud
        $nuevaContrasena = $request->input('password');
    
        // Actualizar la contraseña del usuario en la tabla users
        DB::table('users')
            ->where('email', $email)
            ->update(['password' => Hash::make($nuevaContrasena)]);
    
        // Eliminar el registro de la tabla password_resets para que el código no pueda usarse nuevamente
        DB::table('password_resets')
            ->where('email', $email)
            ->delete();
    
        return response()->json(['message' => 'Contraseña actualizada con éxito']);
    }
    

    
    
}
