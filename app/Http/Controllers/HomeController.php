<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $posts = Post::with(['profile', 'multimedias', 'jobOffers', 'comments.profile'])
                 ->latest()
                 ->paginate(100);

    return view('home', compact('posts'));
}
}