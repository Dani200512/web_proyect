<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\JobOffer;
use App\Models\Multimedia;
use Illuminate\Http\Request;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user || !$user->profile) {
            return redirect()->route('profile.create')->with('error', 'Por favor, crea tu perfil primero.');
        }
        $posts = Post::with('profile')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $jobOffers = JobOffer::where('profile_id', auth()->user()->profile->id)->get();
        return view('posts.create', compact('jobOffers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'publication_type' => 'required',
            'content' => 'required',
            'description' => 'required',
        ]);

        $post = new Post($validatedData);
        $post->profile_id = auth()->user()->profile->id;
        $post->save();

        if ($request->has('job_offers')) {
            $post->jobOffers()->attach($request->job_offers);
        }

        // Asociar contenido multimedia si existe en la sesión
        if (session()->has('multimedia_id')) {
            $multimedia = Multimedia::find(session('multimedia_id'));
            if ($multimedia) {
                $multimedia->post_id = $post->id;
                $multimedia->save();
            }
            session()->forget('multimedia_id');
        }

        return redirect()->route('home')->with('success', 'Publicación creada exitosamente.');
    }
    
    public function show(Post $post)
{
    return view('posts.show', compact('post'));
}

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'publication_type' => 'required',
            'description' => 'required',
            'content' => 'nullable',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post actualizado exitosamente.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post eliminado exitosamente.');
    }

    public function viewProfilePosts($profileId)
    {
        $profile = Profile::findOrFail($profileId);
        $posts = $profile->posts()->latest()->paginate(10);
        return view('posts.profile_posts', compact('posts', 'profile'));
    }

    public function homeIndex()
    {
        $posts = Post::with('profile')->latest()->paginate(10);
        return view('home', compact('posts'));
    }
}
