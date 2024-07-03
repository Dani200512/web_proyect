<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'profilePosts']);
    }

    public function index()
    {
        $posts = Post::with('profile.user')->latest()->paginate(10);
        return view('post.index', compact('posts'));
    }

    public function profilePosts(Profile $profile)
    {
        $posts = $profile->posts()->with('profile.user')->latest()->paginate(10);
        return view('posts.profile_posts', compact('posts', 'profile'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'publication_type' => 'required|string|max:255',
            'content' => 'nullable|string',
            'description' => 'required|string',
        ]);

        $post = Auth::user()->profile->posts()->create($validatedData);

        return redirect()->route('posts.index')->with('success', 'Publicación creada exitosamente.');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validatedData = $request->validate([
            'publication_type' => 'required|string|max:255',
            'content' => 'nullable|string',
            'description' => 'required|string',
        ]);

        $post->update($validatedData);

        return redirect()->route('posts.show', $post)->with('success', 'Publicación actualizada exitosamente.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Publicación eliminada exitosamente.');
    }
}