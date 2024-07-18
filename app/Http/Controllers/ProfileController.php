<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(Request $request, $id = null)
    {
        if ($id === null) {
            $user = Auth::user();
            $isOwner = true;
        } else {
            $user = User::findOrFail($id);
            $isOwner = Auth::id() === $user->id;
        }

        $profile = $user->profile ?? new Profile();
        $posts = $profile->posts()->latest()->get();

        if ($request->wantsJson()) {
            return response()->json([
                'user' => $user,
                'profile' => $profile,
                'posts' => $posts,
                'isOwner' => $isOwner
            ]);
        }

        return view('profile.show', compact('profile', 'isOwner', 'user', 'posts'));
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        if ($request->wantsJson()) {
            return response()->json([
                'profile' => $profile
            ]);
        }

        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        $validator = \Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'Archivo_hvida' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $profile->titulo = $request->titulo;
        $profile->descripcion = $request->descripcion;

        if ($request->hasFile('Archivo_hvida')) {
            if ($profile->Archivo_hvida) {
                Storage::disk('public')->delete($profile->Archivo_hvida);
            }
            $path = $request->file('Archivo_hvida')->store('hv_files', 'public');
            $profile->Archivo_hvida = $path;
        }

        if ($request->hasFile('foto_perfil')) {
            if ($profile->foto_perfil) {
                Storage::disk('public')->delete($profile->foto_perfil);
            }
            $path = $request->file('foto_perfil')->store('profile_photos', 'public');
            $profile->foto_perfil = $path;
        }

        if (!$user->profile) {
            $user->profile()->save($profile);
        } else {
            $profile->save();
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Perfil actualizado exitosamente',
                'profile' => $profile
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'Perfil actualizado exitosamente.');
    }
}
