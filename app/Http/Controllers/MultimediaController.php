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
        $validatedData = $request->validate([
            'file' => 'required|file|max:20480', // 20MB Max
            'type' => 'required|in:photo,video',
            'post_id' => 'required|exists:posts,id'
        ]);

        $file = $request->file('file');
        $type = $request->input('type');

        if ($type === 'photo' && !$file->isValid(['jpeg', 'png', 'jpg', 'gif'])) {
            return back()->withErrors(['file' => 'El archivo debe ser una imagen válida.']);
        }

        if ($type === 'video' && !in_array($file->getMimeType(), ['video/avi', 'video/mpeg', 'video/quicktime', 'video/mp4'])) {
            return back()->withErrors(['file' => 'El archivo debe ser un video válido.']);
        }

        $path = $file->store($type . 's', 'public');

        $multimedia = new Multimedia([
            'type' => $type,
            'path' => $path,
            'post_id' => $request->input('post_id')
        ]);

        $multimedia->save();

        return redirect()->route('posts.show', $request->input('post_id'))->with('success', 'Contenido multimedia agregado exitosamente.');
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
        $validatedData = $request->validate([
            'file' => 'nullable|file|max:20480', // 20MB Max
            'type' => 'required|in:photo,video',
            'post_id' => 'required|exists:posts,id'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $type = $request->input('type');

            if ($type === 'photo' && !$file->isValid(['jpeg', 'png', 'jpg', 'gif'])) {
                return back()->withErrors(['file' => 'El archivo debe ser una imagen válida.']);
            }

            if ($type === 'video' && !in_array($file->getMimeType(), ['video/avi', 'video/mpeg', 'video/quicktime', 'video/mp4'])) {
                return back()->withErrors(['file' => 'El archivo debe ser un video válido.']);
            }

            // Eliminar el archivo anterior
            Storage::disk('public')->delete($multimedia->path);

            // Guardar el nuevo archivo
            $path = $file->store($type . 's', 'public');
            $multimedia->path = $path;
        }

        $multimedia->type = $request->input('type');
        $multimedia->post_id = $request->input('post_id');
        $multimedia->save();

        return redirect()->route('multimedia.show', $multimedia)->with('success', 'Multimedia actualizada con éxito');
    }

    public function destroy(Multimedia $multimedia)
    {
        Storage::disk('public')->delete($multimedia->path);
        $multimedia->delete();

        return redirect()->route('multimedia.index')->with('success', 'Multimedia eliminada con éxito');
    }
}
