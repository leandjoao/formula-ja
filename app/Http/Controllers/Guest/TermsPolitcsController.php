<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class TermsPolitcsController extends Controller
{
    public function terms()
    {

        $terms = Config::select('terms')->first();

        return view('guest.termos', compact('terms'));
    }

    public function politics()
    {
        $privacy = Config::select('privacy')->first();

        return view('guest.politicas', compact('privacy'));
    }
}
