<?php

namespace App\Http\Controllers\Admin\Paginas;

use App\Http\Controllers\Controller;

use App\Models\Paginas\InfoBlog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InfoBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function blog()
    {
        
        $data = InfoBlog::findOrFail(1);
        // dd($data);
        return view('admin.paginas.info-blog', compact('data'));
    }

    public function saveBlog(Request $request)
    {
        $et = $request->all();
        
        $selectTable = InfoBlog::findOrFail(1);
        
        $valid = Validator::make($request->all(), [
            // 'title' => 'required|string'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        if ($request->hasFile('img_banner')) {
            $fileNameBanner = Str::random(64) .'.'. Str::lower($request->file('img_banner')->extension());
            $request->file('img_banner')->storeAs("public/paginas/blog/", $fileNameBanner);
        }else{
            $fileNameBanner = $selectTable->img_banner;
        }

        $infoUpdate = InfoBlog::query()->first();
        $infoUpdate->title_seo = $et['title_seo'];
        $infoUpdate->description_seo = $et['description_seo'];
        $infoUpdate->title_banner = $et['title_banner'];
        $infoUpdate->img_banner = $fileNameBanner;
        $infoUpdate->save();

        return redirect()->back()->with(['status' => ['text' => 'Informações atualizadas!', 'icon' => 'success']]);
    }

}
