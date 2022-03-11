<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Guest\Faq;

class HelpController extends Controller
{
    public function index()
    {
        return view('guest.faq.index');
    }

    public function nonPet()
    {
        $faq = Faq::query()->where('pet', false)->get();
        return view('guest.faq.nonPet', compact('faq'));
    }

    public function pet()
    {
        $faq = Faq::query()->where('pet', true)->get();
        return view('guest.faq.pet', compact('faq'));
    }
}
