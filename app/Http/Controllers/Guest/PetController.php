<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Guest\Banner;
use App\Models\Guest\ExtraTexts;
use App\Models\Guest\Faq;
use App\Models\Guest\HowItWorks;
use App\Models\Post;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index() {
        $banner = Banner::query()->where('isPet', true)->first()->toArray();
        $hiw = HowItWorks::all()->toArray();
        $posts = Post::with('category')->limit(4)->get()->toArray();
        $faqPartner = Faq::where('partner', '=', 1)->where('pet', '=', 1)->limit(4)->get()->toArray();
        $faqUser = Faq::where('partner', '=', 0)->where('pet', '=', 1)->limit(4)->get()->toArray();
        $et = ExtraTexts::select('faq_title', 'faq_text')->get()->toArray()[0];

        $data = [
            "banner" => $banner,
            "hiw" => $hiw,
            "posts" => $posts,
            "faq" => [
                "partner" => $faqPartner,
                "user" => $faqUser,
            ],
            "et" => $et
        ];

        return view('guest.pet', compact('data'));
    }
}
