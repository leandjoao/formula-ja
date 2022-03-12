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

    public function kind($kind)
    {
        switch ($kind) {
            case 'general-user':
                $page = "Dúvidas Gerais - Usuários";
                $faqs = Faq::query()->where('pet', false)->where('partner', false)->get();
                break;

            case 'general-partner':
                $page = "Dúvidas Gerais - Parceiros";
                $faqs = Faq::query()->where('pet', false)->where('partner', true)->get();
                break;

            case 'pet-user':
                $page = "Dúvidas PET - Usuários";
                $faqs = Faq::query()->where('pet', true)->where('partner', false)->get();
                break;

            case 'pet-partner':
                $page = "Dúvidas PET - Parceiros";
                $faqs = Faq::query()->where('pet', true)->where('partner', true)->get();
                break;
            default:
                $page = "Dúvidas";
                $faqs = Faq::all();
                break;
        }

        return view('guest.faq.inner', compact('faqs', 'page'));
    }
}
