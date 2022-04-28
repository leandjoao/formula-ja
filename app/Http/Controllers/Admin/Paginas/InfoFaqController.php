<?php

namespace App\Http\Controllers\Admin\Paginas;

use App\Http\Controllers\Controller;

use App\Models\Paginas\InfoFaq;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InfoFaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function faq()
    {
        
        $data = InfoFaq::findOrFail(1);
        // dd($data);
        return view('admin.paginas.info-faq', compact('data'));
    }

    public function saveFaq(Request $request)
    {
        $et = $request->all();
        
        $selectTable = InfoFaq::findOrFail(1);
        
        $valid = Validator::make($request->all(), [
            // 'title' => 'required|string'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        if ($request->hasFile('img_banner')) {
            $fileNameBanner = Str::random(64) .'.'. Str::lower($request->file('img_banner')->extension());
            $request->file('img_banner')->storeAs("public/paginas/faq/", $fileNameBanner);
        }else{
            $fileNameBanner = $selectTable->img_banner;
        }

        $infoUpdate = InfoFaq::query()->first();
        $infoUpdate->title_seo = $et['title_seo'];
        $infoUpdate->description_seo = $et['description_seo'];
        $infoUpdate->title_banner = $et['title_banner'];
        $infoUpdate->img_banner = $fileNameBanner;
        $infoUpdate->save();

        return redirect()->back()->with(['status' => ['text' => 'Informações atualizadas!', 'icon' => 'success']]);
    }

}
