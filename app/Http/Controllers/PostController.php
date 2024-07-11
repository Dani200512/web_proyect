<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\JobOffer;
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
        $jobOffers = collect(); // Inicializar como colección vacía
        return view('posts.create', compact('jobOffers'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'publication_type' => 'required',
            'description' => 'required',
            'content' => 'nullable',
            'job_offers' => 'nullable|array',
        ]);
    
        $post = Auth::user()->profile->posts()->create($request->except('job_offers'));
    
        if ($request->has('job_offers')) {
            foreach ($request->job_offers as $jobOfferId) {
                $jobOffer = JobOffer::find($jobOfferId);
                if ($jobOffer) {
                    $jobOffer->post_id = $post->id;
                    $jobOffer->save();
                }
            }
        }
    
        return redirect()->route('posts.show', $post->id)->with('success', 'Post creado exitosamente.');
    }
    public function show(Post $post)
    {
        $post->load('jobOffers');
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
