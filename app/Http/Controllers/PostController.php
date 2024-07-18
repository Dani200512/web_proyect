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
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->profile) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Por favor, crea tu perfil primero.'], 403);
            }
            return redirect()->route('profile.create')->with('error', 'Por favor, crea tu perfil primero.');
        }
        $posts = Post::with('profile')->latest()->paginate(10);
        if ($request->wantsJson()) {
            return response()->json($posts);
        }
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
            'publication_type' => 'required|in:general,job_offer',
            'description' => 'required',
            'content' => 'nullable',
            'job_offer.title' => 'required_if:publication_type,job_offer',
            'job_offer.description' => 'required_if:publication_type,job_offer',
            'job_offer.requirements' => 'nullable',
            'job_offer.salary' => 'nullable',
            'job_offer.location' => 'nullable',
            'photo' => 'nullable|image|max:2048', // 2MB Max
            'video' => 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:20480', // 20MB Max
        ]);

        $post = new Post();
        $post->publication_type = $validatedData['publication_type'];
        $post->description = $validatedData['description'];
        $post->content = $validatedData['content'];
        $post->profile_id = auth()->user()->profile->id;
        $post->save();

        if ($post->publication_type === 'job_offer') {
            $jobOffer = new JobOffer($request->job_offer);
            $jobOffer->profile_id = auth()->user()->profile->id;
            $jobOffer->post_id = $post->id;
            $jobOffer->save();
        }

        // Manejar la subida de foto
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('post_photos', 'public');
            $post->multimedias()->create([
                'type' => 'photo',
                'path' => $photoPath
            ]);
        }

        // Manejar la subida de video
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('post_videos', 'public');
            $post->multimedias()->create([
                'type' => 'video',
                'path' => $videoPath
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Publicación creada exitosamente.', 'post' => $post], 201);
        }
        return redirect()->route('home')->with('success', 'Publicación creada exitosamente.');
    }

    public function show(Request $request, Post $post)
    {
        if ($request->wantsJson()) {
            return response()->json($post->load('profile', 'jobOffer', 'multimedias'));
        }
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

        $validatedData = $request->validate([
            'publication_type' => 'required',
            'description' => 'required',
            'content' => 'nullable',
        ]);

        $post->update($validatedData);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Post actualizado exitosamente.', 'post' => $post]);
        }
        return redirect()->route('posts.index')->with('success', 'Post actualizado exitosamente.');
    }

    public function destroy(Request $request, Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Post eliminado exitosamente.'], 200);
        }
        return redirect()->route('posts.index')->with('success', 'Post eliminado exitosamente.');
    }

    public function viewProfilePosts(Request $request, $profileId)
    {
        $profile = Profile::findOrFail($profileId);
        $posts = $profile->posts()->latest()->paginate(10);
        if ($request->wantsJson()) {
            return response()->json(['profile' => $profile, 'posts' => $posts]);
        }
        return view('posts.profile_posts', compact('posts', 'profile'));
    }

    public function homeIndex(Request $request)
    {
        $posts = Post::with('profile')->latest()->paginate(10);
        if ($request->wantsJson()) {
            return response()->json($posts);
        }
        return view('home', compact('posts'));
    }
}
