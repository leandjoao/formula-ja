<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Guest\Banner;
use App\Models\Guest\HowItWorks;
use App\Models\Post;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $banner = Banner::query()->where('isPet', true)->first()->toArray();
        $hiw = HowItWorks::all()->toArray();
        $posts = Post::with('category')->limit(4)->get()->toArray();

        $data = [
            "banner" => $banner,
            "hiw" => $hiw,
            "posts" => $posts
        ];

        return view('guest.pet', compact('data'));
    }
}
