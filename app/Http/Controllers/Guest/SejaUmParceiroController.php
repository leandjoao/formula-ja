<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paginas\InfoParceiro;

class SejaUmParceiroController extends Controller
{
    public function parceiro()
    {

        $getInfo = $this->getInfo();
        $dataPage = InfoParceiro::findOrFail(1);
        // $terms = Config::select('terms')->first();

        return view('guest.seja-um-parceiro', compact('dataPage', 'getInfo'));
    }
}
