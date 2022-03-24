<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Guest\Banner;
use App\Models\Guest\ExtraTexts;
use App\Models\Guest\GetInTouch;
use App\Models\Guest\HowItWorks;
use App\Models\Guest\SocialMedia;
use App\Models\Guest\WhyUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TextController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function home()
    {
        $banner = Banner::all()->toArray();
        $hiw = HowItWorks::all()->toArray();
        $wu = WhyUs::query()->first()->toArray();
        $et = ExtraTexts::select('faq_title', 'faq_text')->get()->toArray()[0];

        $data = ["banner" => $banner, "hiw" => $hiw, "wu" => $wu, "et" => $et ];

        return view('admin.configs.home', compact('data'));
    }

    public function saveHome(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'banner' => 'array',
            'banner.*.image' => 'mimes:png,jpg,jpeg|max:1024',
            'wu' => 'array',
            'wu.image' => 'mimes:png,jpg,jpeg|max:1024',
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $banner = $request->banner;
        $hiw = $request->hiw;
        $wu = $request->wu;
        $et = $request->et;

        if(!empty($banner[1]['image'])) {
            $banner[1]['image']->storeAs('public', 'background.jpg');
        }

        if(!empty($banner[2]['image'])) {
            $banner[2]['image']->storeAs('public', 'background-pet.jpeg');
        }

        if(!empty($wu['image'])) {
            $wu['image']->storeAs('public', 'team.jpeg');
        }

        $bannerUpdate = Banner::query()->where('id', 1)->first();
        $bannerUpdate->super_text = $banner[1]['super_text'];
        $bannerUpdate->slogan = $banner[1]['slogan'];
        $bannerUpdate->under_text = $banner[1]['under_text'];
        $bannerUpdate->save();

        foreach($hiw as $key => $value) {
            $hiwUpdate = HowItWorks::query()->where('id', $key)->first();
            $hiwUpdate->title = $value['title'];
            $hiwUpdate->text = $value['text'];
            $hiwUpdate->save();
        }

        $wuUpdate = WhyUs::query()->first();
        $wuUpdate->title = $wu['title'];
        $wuUpdate->under_title = $wu['under_title'];
        $wuUpdate->text = $wu['text'];
        $wuUpdate->save();

        $etUpdate = ExtraTexts::query()->first();
        $etUpdate->faq_title = $et['faq_title'];
        $etUpdate->faq_text = $et['faq_text'];
        $etUpdate->save();

        return redirect()->back()->with(['status' => ['text' => 'Configurações atualizadas com sucesso!', 'icon' => 'success']]);
    }


    public function infos()
    {
        $extra = ExtraTexts::query()->first();
        $sm = SocialMedia::all();
        $contacts = GetInTouch::all();

        return view('admin.configs.infos', compact('extra', 'sm', 'contacts'));
    }

    public function saveInfos(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'about_us_image' => 'mimes:png,jpg,jpeg|max:1024',
            'team_image' => 'mimes:png,jpg,jpeg|max:1024'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        if(!empty($request->file('about_us_image'))) {
            $request->file('about_us_image')->storeAs('public', 'team.jpeg');
        }

        if(!empty($request->file('team_image'))) {
            $request->file('team_image')->storeAs('public', 'team-banner.jpg');
        }

        foreach ($request->contact as $key => $value) {
            $save = GetInTouch::query()->where('id', $key)->first();
            $save->value = $value;
            $save->save();
        }

        foreach ($request->social as $key => $value) {
            $social = SocialMedia::query()->where('id', $key)->first();
            $social->link = $value;
            $social->save();
        }

        $extraSave = ExtraTexts::query()->first();
        $extraSave->contact_text = $request->contact_text;
        $extraSave->about_us_text = $request->about_us_text;
        $extraSave->team_text = $request->team_text;
        $extraSave->cta = $request->cta;
        $extraSave->save();

        return redirect()->back()->with(['status' => ['text' => 'Informações atualizadas com sucesso!', 'icon' => 'success']]);
    }




    public function policy()
    {
        $policy = Config::select('privacy')->first();

        return view('admin.configs.privacy', compact('policy'));
    }

    public function savePolicy(Request $request)
    {
        $policy = Config::query()->first();
        $policy->privacy = $request->privacy;
        $policy->save();

        return redirect()->back()->with(['status' => ['text' => 'Texto atualizado com sucesso!', 'icon' => 'success']]);
    }




    public function terms()
    {
        $terms = Config::select('terms')->first();

        return view('admin.configs.terms', compact('terms'));
    }

    public function saveTerms(Request $request)
    {
        $terms = Config::query()->first();
        $terms->terms = $request->terms;
        $terms->save();

        return redirect()->back()->with(['status' => ['text' => 'Termos atualizado com sucesso!', 'icon' => 'success']]);
    }


}
