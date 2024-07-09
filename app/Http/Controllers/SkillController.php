<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index()
    {
        // Modificar esta línea para obtener solo las skills del perfil actual
        $skills = auth()->user()->profile->skills;
        return view('skill.index', compact('skills'));
    }

    public function create()
    {
        return view('skill.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $iconPath = $request->file('icon')->store('skills', 'public');

        auth()->user()->profile->skills()->create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $iconPath,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill creada exitosamente.');
    }

    public function show(Skill $skill)
    {
        // Asegurarse de que la skill pertenezca al perfil actual
        if ($skill->profile_id !== auth()->user()->profile->id) {
            abort(403, 'No tienes permiso para ver esta skill.');
        }
        return view('skill.show', compact('skill'));
    }

    public function edit(Skill $skill)
    {
        // Asegurarse de que la skill pertenezca al perfil actual
        if ($skill->profile_id !== auth()->user()->profile->id) {
            abort(403, 'No tienes permiso para editar esta skill.');
        }
        return view('skill.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        // Asegurarse de que la skill pertenezca al perfil actual
        if ($skill->profile_id !== auth()->user()->profile->id) {
            abort(403, 'No tienes permiso para actualizar esta skill.');
        }

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('icon')) {
            if ($skill->icon) {
                Storage::disk('public')->delete($skill->icon);
            }
            $data['icon'] = $request->file('icon')->store('skills', 'public');
        }

        $skill->update($data);

        return redirect()->route('skills.index')->with('success', 'Skill actualizada exitosamente.');
    }

    public function destroy(Skill $skill)
    {
        // Asegurarse de que la skill pertenezca al perfil actual
        if ($skill->profile_id !== auth()->user()->profile->id) {
            abort(403, 'No tienes permiso para eliminar esta skill.');
        }

        if ($skill->icon) {
            Storage::disk('public')->delete($skill->icon);
        }

        $skill->delete();
        return redirect()->route('skills.index')->with('success', 'Skill eliminada exitosamente.');
    }
}
