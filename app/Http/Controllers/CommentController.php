<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        $comment = new Comment([
            'content' => $request->content,
            'profile_id' => Auth::user()->profile->id,
        ]);

        $post->comments()->save($comment);

        return back()->with('success', 'Comentario agregado exitosamente.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return back()->with('success', 'Comentario eliminado exitosamente.');
    }
}