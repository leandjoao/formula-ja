<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $posts = [];
    protected $categorias = [];
    protected $lastPosts = [];

    public function __construct()
    {
        $this->posts = Post::with('category')->paginate(9);
        $this->categorias = Category::withCount('posts')->limit(5)->get()->toArray();
        $this->lastPosts = Post::with('category')->limit(4)->get()->toArray();
        $this->SocialMedia();
    }

    public function index()
    {
        return view('guest.blog.index', [
            'posts' => $this->posts,
            'categorias' => $this->categorias,
            'lastPosts' => $this->lastPosts
        ]);
    }

    public function inner(Request $request)
    {
        $post = Post::query()->with('category')->where('slug', $request->slug)->firstOrFail()->toArray();
        return view('guest.blog.inner', [
            'post' => $post,
            'categorias' => $this->categorias,
            'lastPosts' => $this->lastPosts
        ]);
    }

    public function category(Request $request)
    {
        // dd($request->category);
        $category = Category::query()->where('slug', $request->category)->firstOrFail();
        $posts = Post::query()->where('category_id', $category->id)->paginate(9);

        return view('guest.blog.result', [
            'posts' => $posts,
            'category' => $category,
            'categorias' => $this->categorias,
            'lastPosts' => $this->lastPosts
        ]);
    }

    public function search(Request $request)
    {
        $search = Post::query()->where('title', 'LIKE', '%'.$request->search.'%')->paginate(9);
        if($search->total() == 0) {
            $category = Category::query()->where('label', 'LIKE', '%'.$request->search.'%')->firstOrFail();
            $search = Post::query()->where('category_id', $category->id)->paginate(9);
        }
        
        return view('guest.blog.result', [
            'posts' => $search,
            'category' => ['label' => $request->search],
            'categorias' => $this->categorias,
            'lastPosts' => $this->lastPosts
        ]);
    }
}
