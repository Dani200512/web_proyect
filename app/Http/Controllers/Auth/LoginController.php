<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /*public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            if ($request->wantsJson()) {
                // Para solicitudes API
                
                return response()->json([
                    'user' => $user,
                    'token' => $token,
                    'token_type' => 'Bearer',
                ]);
            } else {
                // Para solicitudes web
                return redirect()->route('home');
            }
        }

        if ($request->wantsJson()) {
            // Para solicitudes API
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        } else {
            // Para solicitudes web
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }*/
    public function login(Request $request)
    {
        try {
            // Validar datos de entrada
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Obtener credenciales de la solicitud
            $credentials = $request->only('email', 'password');

            // Autenticar usuario
            if (!Auth::attempt($credentials)) {
              //  if ($request->wantsJson()) {
                    throw ValidationException::withMessages([
                        'email' => ['Las credenciales proporcionadas son incorrectas.'],
                    ]);
                //}
                //return back()->withErrors(['email' => 'The provided credentials do not match our records.',]);
            }

            // Obtener usuario autenticado
            $user = Auth::user();

            // Verificar si el usuario tiene el rol necesario (ej. 'customer')
           /* if (!$user->roles->contains('name', 'customer')) {
                Auth::logout();
                if ($request->wantsJson()) {
                    throw ValidationException::withMessages([
                        'email' => ['No tienes permiso para acceder a esta área.'],
                    ]);
                }
                return back()->withErrors(['role' => 'You do not have permission to access this area.',]);
            }*/

            // Generar token de acceso JWT
            $token = $user->createToken('API Token')->plainTextToken;
            if ($request->wantsJson()) {
                // Respuesta JSON con el token
                return response()->json([
                   // 'message' => 'Login exitoso',
                    'token' => $token,
                    'user' => $user
                ],200);
            }
           // return redirect()->route('home.customer');

        } catch (ValidationException $e) {
            return response()->json(['message' => $e->errors()], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        if ($request->wantsJson()) {
            // Para solicitudes API
            
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        } else {
            // Para solicitudes web
            Auth::logout();
            return redirect()->route('login.form');
        }
    }

    // Estos métodos ahora son alias para mantener compatibilidad con tus rutas existentes
    public function apiLogin(Request $request)
    {
        return $this->login($request);
    }

    public function apiLogout(Request $request)
    {
        return $this->logout($request);
    }
}
