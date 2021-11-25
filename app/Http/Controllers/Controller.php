<?php

namespace App\Http\Controllers;

use App\Models\Guest\ExtraTexts;
use App\Models\Guest\SocialMedia;
use App\Models\Partner;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->SocialMedia();
        $this->Partners();
        $this->PartnersPet();
        $this->CTA();
    }

    protected function adminAccess()
    {
        if(Auth::user()->access_level != 1) {
            return abort(403);
        }
    }

    protected function pharmacyAccess()
    {
        if(Auth::user()->access_level != 1 || Auth::user()->access_level != 3) {
            return abort(403);
        }
    }

    protected function SocialMedia()
    {
        $sm = SocialMedia::all()->toArray();
        view()->share('sm', $sm);
    }

    protected function PartnersPet()
    {
        $partnersPet = Partner::query()->where('pet', true)->get()->toArray();
        view()->share('partnersPet', $partnersPet);
    }

    protected function Partners()
    {
        $partners = Partner::query()->where('pet', false)->get()->toArray();
        view()->share('partners', $partners);
    }

    protected function CTA()
    {
        $et = ExtraTexts::select('cta')->get()->toArray()[0]['cta'];
        view()->share('cta', $et);
    }

}
