<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\InfoGeral;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfoGeralController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        
        $data = InfoGeral::findOrFail(1);
        // dd($data);
        return view('admin.info.info-geral', compact('data'));
    }

    public function edit(Request $request)
    {
        $et = $request->all();
        
        $valid = Validator::make($request->all(), [
            'title' => 'required|string'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $infoUpdate = InfoGeral::query()->first();
        $infoUpdate->title = $et['title'];
        $infoUpdate->description = $et['description'];
        $infoUpdate->celular = $et['celular'];
        $infoUpdate->telefone = $et['telefone'];
        $infoUpdate->email = $et['email'];
        $infoUpdate->cta = $et['cta'];
        $infoUpdate->facebook = $et['facebook'];
        $infoUpdate->instagram = $et['instagram'];
        $infoUpdate->linkedin = $et['linkedin'];
        $infoUpdate->twitter = $et['twitter'];
        $infoUpdate->youtube = $et['youtube'];
        $infoUpdate->save();

        return redirect()->back()->with(['status' => ['text' => 'Informações atualizadas com sucesso!', 'icon' => 'success']]);
    }

}
