<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Guest\ExtraTexts;
use App\Models\Guest\WhyUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $text = ExtraTexts::query()->first();

        return view('guest.about', compact('text'));
    }
}
