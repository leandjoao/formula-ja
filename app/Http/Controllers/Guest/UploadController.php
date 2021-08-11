<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('guest.enviarReceita');
    }

    public function pet()
    {
        return view('guest.enviarReceita');
    }


    public function send(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "phone" => "required",
            "file" => "required|file|mimes:png,jpg,pdf,jpeg|max:2048"
        ]);

        if($valid->fails()) return redirect()->back()->withErrors($valid)->withInput();

        $user = User::query()->where('email', $request->email)->first();

        if(!$user) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->phone);
            $user->access_level = 2;
            $user->phone = $request->phone;
            $user->save();
        }

        $fileName = Str::random(64) .'.'. $request->file->extension();
        $request->file->storeAs("public/uploads/", $fileName);

        $upload = new Upload();
        $upload->file = $fileName;
        $upload->user_id = $user->id;
        $upload->save();

        $budget = new Budget();
        $budget->upload_id = $upload->id;
        $budget->user_id = $user->id;
        $budget->pet = boolval($request->pet);
        $budget->save();

        // TODO: Disparar e-mail alertando que enviou a receita

        return redirect()->back()->with(['status' => ['text' => 'Recebemos a sua receita!', 'icon' => 'success']]);
    }
}
