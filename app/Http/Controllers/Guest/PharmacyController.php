<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PharmacyController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $valid = Validator::make($request->all(), [
            "name" => "required",
            "zip" => "required",
            "street" => "required",
            "neighborhood" => "required",
            "city" => "required",
            "state" => "required",
            "number" => "required",
            "phone" => "required",
            "file" => "mimes:png,jpg,jpeg,gif|max:1024",
            "owner_name" => "required",
            "owner_email" => "required|email|unique:users,email",
            "owner_phone" => "required",
            "pet" => "required"
        ]);

        if($valid->fails()) return response()->json($valid->errors(), 500);

        $user = User::query()->where('email', $request->owner_email)->first();

        if(!$user) {
            $user = new User();
            $user->name = $request->owner_name;
            $user->email = $request->owner_email;
            $user->password = Hash::make($request->owner_phone);
            $user->access_level = 3;
            $user->phone = $request->owner_phone;
            $user->save();
        }

        $logoName = Str::slug($request->name) .'-logo.'. $request->file->extension();
        $request->file->storeAs("public/logos/", $logoName);

        $pharmacy = new Pharmacy();
        $pharmacy->name = $request->name;
        $pharmacy->street = $request->street;
        $pharmacy->neighborhood = $request->neighborhood;
        $pharmacy->city = $request->city;
        $pharmacy->state = $request->state;
        $pharmacy->number = $request->number;
        $pharmacy->phone = $request->phone;
        $pharmacy->logo = $logoName;
        $pharmacy->owner_id = $user->id;
        $pharmacy->pet = boolval($request->pet);
        $pharmacy->save();

        return response()->json(['message' => 'Sucesso! '. $request->name .' criada!']);
    }
}
