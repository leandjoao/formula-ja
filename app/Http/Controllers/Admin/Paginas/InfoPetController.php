<?php

namespace App\Http\Controllers\Admin\Paginas;

use App\Http\Controllers\Controller;

use App\Models\Paginas\InfoPet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InfoPetController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function pet()
    {
        
        $data = InfoPet::findOrFail(1);
        // dd($data);
        return view('admin.paginas.info-pet', compact('data'));
    }

    public function savePet(Request $request)
    {
        $et = $request->all();
        
        $selectPet = InfoPet::findOrFail(1);
        
        $valid = Validator::make($request->all(), [
            // 'title' => 'required|string'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        if ($request->hasFile('img_banner')) {
            $fileNameBanner = Str::random(64) .'.'. Str::lower($request->file('img_banner')->extension());
            $request->file('img_banner')->storeAs("public/paginas/pet/", $fileNameBanner);
        }else{
            $fileNameBanner = $selectPet->img_banner;
        }

        // if ($request->hasFile('img_about')) {
        //     $fileNameAbout = Str::random(64) .'.'. Str::lower($request->file('img_about')->extension());
        //     $request->file('img_about')->storeAs("public/paginas/home/", $fileNameAbout);
        // }else{
        //     $fileNameAbout = $selectHome->img_about;
        // }

        // if ($request->hasFile('img_pet')) {
        //     $fileNamePet = Str::random(64) .'.'. Str::lower($request->file('img_pet')->extension());
        //     $request->file('img_pet')->storeAs("public/paginas/home/", $fileNamePet);
        // }else{
        //     $fileNamePet = $selectHome->img_pet;
        // }

        $infoUpdate = InfoPet::query()->first();
        $infoUpdate->title_seo = $et['title_seo'];
        $infoUpdate->description_seo = $et['description_seo'];
        $infoUpdate->tag_banner = $et['tag_banner'];
        $infoUpdate->title_banner = $et['title_banner'];
        $infoUpdate->subtitle_banner = $et['subtitle_banner'];
        $infoUpdate->img_banner = $fileNameBanner;
        $infoUpdate->title_como_funciona = $et['title_como_funciona'];
        $infoUpdate->title_cf1 = $et['title_cf1'];
        $infoUpdate->subtitle_cf1 = $et['subtitle_cf1'];
        $infoUpdate->title_cf2 = $et['title_cf2'];
        $infoUpdate->subtitle_cf2 = $et['subtitle_cf2'];
        $infoUpdate->title_cf3 = $et['title_cf3'];
        $infoUpdate->subtitle_cf3 = $et['subtitle_cf3'];
        $infoUpdate->title_cf4 = $et['title_cf4'];
        $infoUpdate->subtitle_cf4 = $et['subtitle_cf4'];
        $infoUpdate->title_cf5 = $et['title_cf5'];
        $infoUpdate->subtitle_cf5 = $et['subtitle_cf5'];
        // $infoUpdate->title_about = $et['title_about'];
        // $infoUpdate->subtitle_about = $et['subtitle_about'];
        // $infoUpdate->txt_about = $et['txt_about'];
        // $infoUpdate->img_about = $fileNameAbout;
        // $infoUpdate->title_pet = $et['title_pet'];
        // $infoUpdate->subtitle_pet = $et['subtitle_pet'];
        // $infoUpdate->img_pet = $fileNamePet;
        $infoUpdate->title_blog = $et['title_blog'];
        $infoUpdate->subtitle_blog = $et['subtitle_blog'];
        $infoUpdate->title_depoimentos = $et['title_depoimentos'];
        $infoUpdate->subtitle_depoimentos = $et['subtitle_depoimentos'];
        $infoUpdate->title_faq = $et['title_faq'];
        $infoUpdate->subtitle_faq = $et['subtitle_faq'];
        $infoUpdate->save();

        return redirect()->back()->with(['status' => ['text' => 'Informações atualizadas!', 'icon' => 'success']]);
    }

}
