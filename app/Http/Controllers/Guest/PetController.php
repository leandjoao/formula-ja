<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->limit(4)->get()->toArray();

        return view('guest.pet', compact('posts'));
    }
}
