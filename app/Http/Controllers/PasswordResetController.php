<?php


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TokenService;
use App\Services\EmailService;
use App\Models\User;
use App\Models\RecoveryToken;
use App\Models\RecoveryCode;

class PasswordResetController extends Controller
{
    public function requestPasswordReset(Request $request)
    {
        try {
            $email = $request->input('email');
            $user = User::where('Correo', $email)->first();

            if (!$user) {
                return response()->json(['error' => 'El correo electrónico no está registrado en nuestra base de datos.'], 404);
            }

            $token = TokenService::generateToken($email);
            $expirationDate = now()->addHour(); // Token válido por 1 hora

            $recoveryToken = new RecoveryToken([
                'email' => $email,
                'token' => $token,
                'expirationDate' => $expirationDate,
            ]);

            $recoveryToken->save();

            EmailService::sendRecoveryEmail($email, $token);

            return response()->json(['success' => true, 'message' => 'Se ha enviado un correo electrónico con el enlace de recuperación.']);
        } catch (\Exception $error) {
            \Log::error('Error al procesar la solicitud de recuperación de contraseña: ' . $error->getMessage());
            return response()->json(['success' => false, 'message' => 'Ocurrió un error al procesar la solicitud. Inténtalo de nuevo más tarde.'], 500);
        }
    }

    public function resetPassword(Request $request, $token)
    {
        try {
            $password = $request->input('password');
            $recoveryToken = RecoveryToken::where('token', $token)
                ->where('expirationDate', '>', now())
                ->first();

            if (!$recoveryToken) {
                return response()->json(['error' => 'El token no es válido o ha expirado. Solicita nuevamente la recuperación de contraseña.'], 400);
            }

            $user = User::where('Correo', $recoveryToken->email)->first();

            if (!$user) {
                return response()->json(['error' => 'El correo electrónico asociado al token no está registrado en nuestra base de datos.'], 404);
            }

            // Asignamos directamente la nueva contraseña en texto plano proporcionada por el usuario
            $user->Contrasena = $password;
            $user->save();

            $recoveryToken->delete();

            return response()->json(['success' => true, 'message' => 'Contraseña restablecida con éxito. Ahora puedes iniciar sesión con tu nueva contraseña.']);
        } catch (\Exception $error) {
            \Log::error('Error al procesar el restablecimiento de contraseña: ' . $error->getMessage());
            return response()->json(['success' => false, 'message' => 'Ocurrió un error al procesar la solicitud. Inténtalo de nuevo más tarde.'], 500);
        }
    }

    
}
