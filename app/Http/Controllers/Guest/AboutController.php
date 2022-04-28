<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Guest\ExtraTexts;
use App\Models\Guest\WhyUs;
use Illuminate\Http\Request;
use App\Models\Paginas\InfoAbout;

class AboutController extends Controller
{
    public function index()
    {
        $getInfo = $this->getInfo();
        $text = ExtraTexts::query()->first();
        $dataPage = InfoAbout::findOrFail(1);

        return view('guest.about', compact('text', 'dataPage', 'getInfo'));
    }
}
