<?php

namespace App\Http\Controllers\Admin\Paginas;

use App\Http\Controllers\Controller;

use App\Models\Paginas\InfoAbout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InfoAboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function about()
    {
        
        $data = InfoAbout::findOrFail(1);
        // dd($data);
        return view('admin.paginas.info-about', compact('data'));
    }

    public function saveAbout(Request $request)
    {
        $et = $request->all();
        
        $selectTable = InfoAbout::findOrFail(1);
        
        $valid = Validator::make($request->all(), [
            // 'title' => 'required|string'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        if ($request->hasFile('img_banner')) {
            $fileNameBanner = Str::random(64) .'.'. Str::lower($request->file('img_banner')->extension());
            $request->file('img_banner')->storeAs("public/paginas/about/", $fileNameBanner);
        }else{
            $fileNameBanner = $selectTable->img_banner;
        }

        if ($request->hasFile('img_about')) {
            $fileNameAbout = Str::random(64) .'.'. Str::lower($request->file('img_about')->extension());
            $request->file('img_about')->storeAs("public/paginas/about/", $fileNameAbout);
        }else{
            $fileNameAbout = $selectTable->img_about;
        }

        if ($request->hasFile('img_equipe')) {
            $fileNameEquipe = Str::random(64) .'.'. Str::lower($request->file('img_equipe')->extension());
            $request->file('img_equipe')->storeAs("public/paginas/about/", $fileNameEquipe);
        }else{
            $fileNameEquipe = $selectTable->img_equipe;
        }

        $infoUpdate = InfoAbout::query()->first();
        $infoUpdate->title_seo = $et['title_seo'];
        $infoUpdate->description_seo = $et['description_seo'];
        $infoUpdate->title_banner = $et['title_banner'];
        $infoUpdate->img_banner = $fileNameBanner;
        $infoUpdate->txt_about = $et['txt_about'];
        $infoUpdate->img_about = $fileNameAbout;
        $infoUpdate->title_equipe = $et['title_equipe'];
        $infoUpdate->txt_equipe = $et['txt_equipe'];
        $infoUpdate->img_equipe = $fileNameEquipe;
        $infoUpdate->title_parceiros = $et['title_parceiros'];
        $infoUpdate->save();

        return redirect()->back()->with(['status' => ['text' => 'Informações atualizadas!', 'icon' => 'success']]);
    }

}
