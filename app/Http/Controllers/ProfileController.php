<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show($id = null)
    {
        if ($id) {
            $profile = Profile::findOrFail($id);
        } else {
            $user = Auth::user();
            $profile = $user->profile ?? new Profile();
        }
        $posts = $profile->posts()->latest()->paginate(10);
        return view('profile.show', compact('profile', 'posts'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'Archivo_hvida' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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

        $user->profile()->save($profile);

        return redirect()->route('profile.show')->with('success', 'Perfil actualizado exitosamente.');
    }
}
