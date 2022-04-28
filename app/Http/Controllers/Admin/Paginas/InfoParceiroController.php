<?php

namespace App\Http\Controllers\Admin\Paginas;

use App\Http\Controllers\Controller;

use App\Models\Paginas\InfoParceiro;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InfoParceiroController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function parceiro()
    {
        
        $data = InfoParceiro::findOrFail(1);
        // dd($data);
        return view('admin.paginas.info-parceiro', compact('data'));
    }

    public function saveParceiro(Request $request)
    {
        $et = $request->all();
        
        $selectTable = InfoParceiro::findOrFail(1);
        
        $valid = Validator::make($request->all(), [
            // 'title' => 'required|string'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        if ($request->hasFile('img_banner')) {
            $fileNameBanner = Str::random(64) .'.'. Str::lower($request->file('img_banner')->extension());
            $request->file('img_banner')->storeAs("public/paginas/parceiro/", $fileNameBanner);
        }else{
            $fileNameBanner = $selectTable->img_banner;
        }

        if ($request->hasFile('img_about')) {
            $fileNameAbout = Str::random(64) .'.'. Str::lower($request->file('img_about')->extension());
            $request->file('img_about')->storeAs("public/paginas/parceiro/", $fileNameAbout);
        }else{
            $fileNameAbout = $selectTable->img_about;
        }

        if ($request->hasFile('img_cta')) {
            $fileNameCta = Str::random(64) .'.'. Str::lower($request->file('img_cta')->extension());
            $request->file('img_cta')->storeAs("public/paginas/parceiro/", $fileNameCta);
        }else{
            $fileNameCta = $selectTable->img_cta;
        }

        $infoUpdate = InfoParceiro::query()->first();
        $infoUpdate->title_seo = $et['title_seo'];
        $infoUpdate->description_seo = $et['description_seo'];
        $infoUpdate->title_banner = $et['title_banner'];
        $infoUpdate->subtitle_banner = $et['subtitle_banner'];
        $infoUpdate->img_banner = $fileNameBanner;
        
        $infoUpdate->title_numeros = $et['title_numeros'];
        $infoUpdate->title_numero1 = $et['title_numero1'];
        $infoUpdate->subtitle_numero1 = $et['subtitle_numero1'];
        $infoUpdate->title_numero2 = $et['title_numero2'];
        $infoUpdate->subtitle_numero2 = $et['subtitle_numero2'];
        $infoUpdate->title_numero3 = $et['title_numero3'];
        $infoUpdate->subtitle_numero3 = $et['subtitle_numero3'];
        
        $infoUpdate->title_about = $et['title_about'];
        $infoUpdate->subtitle_about = $et['subtitle_about'];
        $infoUpdate->txt_about = $et['txt_about'];
        $infoUpdate->img_about = $fileNameAbout;

        $infoUpdate->title_diferenciais = $et['title_diferenciais'];
        $infoUpdate->title_diferencial1 = $et['title_diferencial1'];
        $infoUpdate->subtitle_diferencial1 = $et['subtitle_diferencial1'];
        $infoUpdate->title_diferencial2 = $et['title_diferencial2'];
        $infoUpdate->subtitle_diferencial2 = $et['subtitle_diferencial2'];
        $infoUpdate->title_diferencial3 = $et['title_diferencial3'];
        $infoUpdate->subtitle_diferencial3 = $et['subtitle_diferencial3'];
        
        $infoUpdate->title_depoimentos = $et['title_depoimentos'];
        $infoUpdate->subtitle_depoimentos = $et['subtitle_depoimentos'];

        $infoUpdate->title_cta = $et['title_cta'];
        $infoUpdate->subtitle_cta = $et['subtitle_cta'];
        $infoUpdate->img_cta = $fileNameCta;

        $infoUpdate->title_form = $et['title_form'];
        $infoUpdate->subtitle_form = $et['subtitle_form'];
        
        $infoUpdate->save();

        return redirect()->back()->with(['status' => ['text' => 'Informações atualizadas!', 'icon' => 'success']]);
    }

}
