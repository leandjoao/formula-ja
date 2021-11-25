<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Guest\Banner;
use App\Models\Guest\ExtraTexts;
use App\Models\Guest\Faq;
use App\Models\Guest\HowItWorks;
use App\Models\Guest\WhyUs;
use App\Models\Post;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->limit(4)->get()->toArray();
        $banner = Banner::query()->where('isPet', false)->first()->toArray();
        $pet = Banner::select('slogan')->where('isPet', true)->first()->toArray()['slogan'];
        $hiw = HowItWorks::all()->toArray();
        $wu = WhyUs::query()->first()->toArray();
        $faq = Faq::all()->random(4)->toArray();
        $et = ExtraTexts::select('faq_title', 'faq_text')->get()->toArray()[0];

        $data = [
            "posts" => $posts,
            "banner" => $banner,
            "petSlogan" => $pet,
            "hiw" => $hiw,
            "wu" => $wu,
            "faq" => $faq,
            "et" => $et
        ];

        return view('guest.index', compact('data'));
    }
}
