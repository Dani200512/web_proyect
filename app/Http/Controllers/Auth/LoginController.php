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

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($request->wantsJson()) {
                // Para solicitudes API
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'user' => $user,
                    'access_token' => $token,
                    /*'token_type' => 'Bearer',*/
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
    }

    public function logout(Request $request)
    {
        if ($request->wantsJson()) {
            // Para solicitudes API
            $request->user()->currentAccessToken()->delete();
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
