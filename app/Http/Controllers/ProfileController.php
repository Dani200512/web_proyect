<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Auth::user()->profile;
        return view('profile.show', compact('profile'));
    }

    public function edit()
    {
        $profile = Auth::user()->profile;
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

        $profile->fill($request->only(['titulo', 'descripcion']));

        if ($request->hasFile('Archivo_hvida')) {
            $path = $request->file('Archivo_hvida')->store('hv_files', 'public');
            $profile->Archivo_hvida = $path;
        }

        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('profile_photos', 'public');
            $profile->foto_perfil = $path;
        }

        $user->profile()->save($profile);

        return redirect()->route('profile.show')->with('success', 'Perfil actualizado exitosamente.');
    }
}
