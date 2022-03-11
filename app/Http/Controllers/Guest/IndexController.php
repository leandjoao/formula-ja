<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Guest\Banner;
use App\Models\Guest\ExtraTexts;
use App\Models\Guest\Faq;
use App\Models\Guest\HowItWorks;
use App\Models\Guest\WhyUs;
use App\Models\Post;
use App\Models\Testemonial;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->limit(4)->get()->toArray();
        $banner = Banner::query()->where('isPet', false)->first()->toArray();
        $pet = Banner::select('slogan')->where('isPet', true)->first()->toArray()['slogan'];
        $hiw = HowItWorks::all()->toArray();
        $wu = WhyUs::query()->first()->toArray();
        $faqPartner = Faq::where('partner', '=' , 1)->where('pet', '!=', 1)->limit(4)->get()->toArray();
        $faqUser = Faq::where('partner', '=' , 0)->where('pet', '!=', 1)->limit(4)->get()->toArray();
        $et = ExtraTexts::select('faq_title', 'faq_text')->get()->toArray()[0];
        $testemonials = Testemonial::inRandomOrder()->limit(6)->get()->toArray();

        $data = [
            "posts" => $posts,
            "banner" => $banner,
            "petSlogan" => $pet,
            "hiw" => $hiw,
            "wu" => $wu,
            "faq" => [
                "partner" => $faqPartner,
                "user" => $faqUser,
            ],
            "et" => $et,
            "depoimentos" => $testemonials
        ];

        return view('guest.index', compact('data'));
    }
}
