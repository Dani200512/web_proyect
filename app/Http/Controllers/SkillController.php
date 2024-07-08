<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
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

        Skill::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $iconPath,
            'profile_id' => auth()->user()->profile->id,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill creada exitosamente.');
    }

    public function show(Skill $skill)
    {
        return view('skill.show', compact('skill'));
    }

    public function edit(Skill $skill)
    {
        return view('skill.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('icon')) {
            // Eliminar el icono anterior si existe
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
        // Eliminar el archivo de icono si existe
        if ($skill->icon) {
            Storage::disk('public')->delete($skill->icon);
        }

        $skill->delete();
        return redirect()->route('skills.index')->with('success', 'Skill eliminada exitosamente.');
    }
}