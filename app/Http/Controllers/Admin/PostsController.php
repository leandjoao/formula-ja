<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Generator $faker)
    {
        $posts = Post::query()->with('category')->paginate(10);
        return view('admin.blog.listing', compact('posts'));
    }

    public function new()
    {
        $categories = Category::all()->toArray();

        if(count($categories) == 0) {
            return redirect()->route('blog.category.new')->with(['status' => ['text' => 'É necessário criar ao menos uma categoria antes!', 'icon' => 'warning']]);
        }

        return view('admin.blog.create', compact('categories'));
    }

    public function save(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "title" => "required",
            "category" => "required|exists:categories,id",
            "text" => "required",
            "banner" => "required|file|mimes:png,jpg,jpeg|max:2048"
        ]);

        if($valid->fails()) return redirect()->back()->withErrors($valid)->withInput();

        $fileName = Str::random(64) .'.'. Str::lower($request->file('banner')->extension());
        $request->file('banner')->storeAs("public/blog/", $fileName);

        $post = new Post();
        $post->title = $request->title;
        $post->category_id = $request->category;
        $post->slug = Str::slug($request->title);
        $post->content = $request->text;
        $post->banner = $fileName;
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('blog')->with(['status' => ['text' => 'Post criado!', 'icon' => 'success']]);
    }

    public function remove($slug)
    {
        $post = Post::query()->where('slug', '=', $slug)->first();
        $post->delete();

        return redirect()->route('blog')->with(['status' => ['text' => 'Post removido!', 'icon' => 'success']]);
    }

    // Categorias

    public function category()
    {
        $categories = Category::query()->withCount('posts')->paginate(10);
        return view('admin.blog.category.listing', compact('categories'));
    }

    public function newCategory()
    {
        return view('admin.blog.category.create');
    }

    public function saveCategory(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "label" => "required|unique:categories,label",
        ]);

        if($valid->fails()) return redirect()->back()->withErrors($valid)->withInput();

        $category = new Category();
        $category->label = Str::ucfirst(Str::lower($request->label));
        $category->save();

        return redirect()->route('blog.category')->with(['status' => ['text' => 'Categoria criada!', 'icon' => 'success']]);
    }

    public function removeCategory($id)
    {
        $category = Category::query()->where('id', '=', $id)->withCount('posts')->first();

        if($category->posts_count !== 0) {
            return redirect()->route('blog.category')->with(['status' => ['text' => 'Não é possível remover categoria com posts!', 'icon' => 'error']]);
        }

        $category->delete();

        return redirect()->route('blog.category')->with(['status' => ['text' => 'Categoria removida!', 'icon' => 'success']]);
    }
}
