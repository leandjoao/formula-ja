<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest\ExtraTexts;
use App\Models\Guest\GetInTouch;
use App\Models\Guest\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $configs = ExtraTexts::query()->first();
        return view('admin.configs.edit', compact('configs'));
    }

    public function saveEdit(Request $request)
    {
        $config = ExtraTexts::query()->first();
        $config->faq_title = $request->faq_title;
        $config->faq_text = $request->faq_text;
        $config->cta = $request->cta;
        $config->about_us_text = $request->about_us_text;
        if($request->file('about_us_image')) {
            $fileName = 'team.jpeg';
            $request->file('about_us_image')->storeAs('public/',$fileName);
            $config->about_us_image = $fileName;
        }
        $config->team_text = $request->team_text;
        if($request->file('team_image')) {
            $teamImage = 'team-banner.jpg';
            $request->file('team_image')->storeAs('public/',$teamImage);
            $config->team_image = $teamImage;
        }
        $config->contact_text = $request->contact_text;
        $config->save();

        return redirect()->back()->with(['status' => ['text' => 'Atualizado!', 'icon' => 'success']]);
    }

    public function infos()
    {
        $infos = GetInTouch::all();
        $sm = SocialMedia::all();

        return view('admin.configs.infos', compact('infos', 'sm'));
    }

    public function infosSave(Request $request)
    {
        foreach($request->social as $key=>$social) {
            $save = SocialMedia::query()->where('id', $key)->first();
            $save->link = $social;
            $save->save();
        }

        foreach($request->info as $key=>$info) {
            $save = GetInTouch::query()->where('id', $key)->first();
            $save->value = $info;
            $save->save();
        }

        return redirect()->back()->with(['status' => ['text' => 'Atualizado!', 'icon' => 'success']]);
    }

}
