<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function toggle(Request $request, Post $post)
{
    $request->validate([
        'type_reaction' => 'required|in:like,love,haha,wow,sad,angry',
    ]);

    $reaction = Reaction::where('post_id', $post->id)
        ->where('profile_id', Auth::user()->profile->id)
        ->first();

    if ($reaction) {
        if ($reaction->type_reaction === $request->type_reaction) {
            $reaction->delete();
            return back()->with('success', 'Reacción eliminada.');
        } else {
            $reaction->update(['type_reaction' => $request->type_reaction]);
            return back()->with('success', 'Reacción actualizada.');
        }
    } else {
        Reaction::create([
            'type_reaction' => $request->type_reaction,
            'post_id' => $post->id,
            'profile_id' => Auth::user()->profile->id,
        ]);
        return back()->with('success', 'Reacción agregada.');
    }
}
}