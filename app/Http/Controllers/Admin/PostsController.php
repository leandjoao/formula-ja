<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(Generator $faker)
    {
        $posts = [];
        for($i=0; $i<10; $i++) {
            array_push($posts, [
                'name' => $faker->word(),
                'category' => 'teste',
                'author' => Auth::user()->name,
                'created_at' => Carbon::now()
            ]);
        }

        return view('admin.blog.listing', compact('posts'));
    }

    public function category()
    {
        $categories = [
            [
                'label' => 'teste',
                'posts' => 10,
                'created_at' => Carbon::now()
            ],
        ];

        return view('admin.blog.category.listing', compact('categories'));
    }
}
