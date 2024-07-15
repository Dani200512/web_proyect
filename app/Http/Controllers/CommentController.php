<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'content' => 'required|max:1000',
        'post_id' => 'required|exists:posts,id',
    ]);

    $comment = Comment::create([
        'content' => $request->content,
        'profile_id' => Auth::user()->profile->id,
        'post_id' => $request->post_id,
    ]);

    return redirect()->route('home')->with('success', 'Comentario agregado exitosamente.');
}
    public function edit(Comment $comment)
    {
        if (Auth::user()->profile->id !== $comment->profile_id) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este comentario.');
        }
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        if (Auth::user()->profile->id !== $comment->profile_id) {
            return redirect()->back()->with('error', 'No tienes permiso para actualizar este comentario.');
        }

        $request->validate([
            'content' => 'required|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comentario actualizado exitosamente.');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::user()->profile->id !== $comment->profile_id && Auth::user()->profile->id !== $comment->post->profile_id) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
        }
        
        $comment->delete();
        return back()->with('success', 'Comentario eliminado exitosamente.');
    }
}