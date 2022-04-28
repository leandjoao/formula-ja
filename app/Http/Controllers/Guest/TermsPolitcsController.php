<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class TermsPolitcsController extends Controller
{
    public function terms()
    {

        $getInfo = $this->getInfo();
        $terms = Config::select('terms')->first();

        return view('guest.termos', compact('terms', 'getInfo'));
    }

    public function politics()
    {
        $getInfo = $this->getInfo();
        $privacy = Config::select('privacy')->first();

        return view('guest.politicas', compact('privacy', 'getInfo'));
    }
}
