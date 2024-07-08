<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MultimediaController extends Controller
{
    public function index()
    {
        $multimedia = Multimedia::all();
        return view('multimedia.index', compact('multimedia'));
    }

    public function create()
    {
        return view('multimedia.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20480',
            'post_id' => 'required|exists:posts,id'
        ]);

        $multimedia = new Multimedia();
        $multimedia->post_id = $request->post_id;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $multimedia->photo = $path;
        }

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos', 'public');
            $multimedia->video = $path;
        }

        $multimedia->save();

        return response()->json(['message' => 'Multimedia subida con éxito', 'multimedia' => $multimedia]);
    }

    public function show(Multimedia $multimedia)
    {
        return view('multimedia.show', compact('multimedia'));
    }

    public function edit(Multimedia $multimedia)
    {
        return view('multimedia.edit', compact('multimedia'));
    }

    public function update(Request $request, Multimedia $multimedia)
    {
        $request->validate([
            'photo' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20480',
            'post_id' => 'required|exists:posts,id'
        ]);

        if ($request->hasFile('photo')) {
            if ($multimedia->photo) {
                Storage::disk('public')->delete($multimedia->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $multimedia->photo = $path;
        }

        if ($request->hasFile('video')) {
            if ($multimedia->video) {
                Storage::disk('public')->delete($multimedia->video);
            }
            $path = $request->file('video')->store('videos', 'public');
            $multimedia->video = $path;
        }

        $multimedia->post_id = $request->post_id;
        $multimedia->save();

        return redirect()->route('multimedia.show', $multimedia)->with('success', 'Multimedia actualizada con éxito');
    }




    public function destroy(Multimedia $multimedia)
    {
        if ($multimedia->photo) {
            Storage::disk('public')->delete($multimedia->photo);
        }
        if ($multimedia->video) {
            Storage::disk('public')->delete($multimedia->video);
        }

        $multimedia->delete();

        return redirect()->route('multimedia.index')->with('success', 'Multimedia eliminada con éxito');
    }


}
