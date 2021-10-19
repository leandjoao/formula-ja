<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function update(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->back()->with(['status' => ['text' => 'Perfil atualizado!', 'icon' => 'success']]);
    }

    public function changePassword(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'old_pass' => 'required',
            'new_pass' => 'required|confirmed|min:8',
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $user = User::find(Auth::user()->id);

        if(Hash::check($request->old_pass, $user->password)) {
            $user->password = Hash::make($request->new_pass);
            $user->save();

            return redirect()->back()->with(['status' => ['text' => 'Senha atualizada!', 'icon' => 'success']]);
        }

        return redirect()->back()->with(['status' => ['text' => 'Senha inválida!', 'icon' => 'error']]);
    }

    public function changeAddress(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'cep' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required|max:2',
            'number' => 'required',
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $address = Address::query()->where('user_id', Auth::user()->id)->get();

        if($address) {
            $address->cep = $request->cep;
            $address->address = $request->address;
            $address->neighborhood = $request->neighborhood;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->number = $request->number;
            $address->complement = $request->complement;
            $address->reference = $request->reference;
            $address->save();
        } else {
            $newAddress = new Address();
            $newAddress->user_id = Auth::user()->id;
            $newAddress->cep = $request->cep;
            $newAddress->address = $request->address;
            $newAddress->neighborhood = $request->neighborhood;
            $newAddress->city = $request->city;
            $newAddress->state = $request->state;
            $newAddress->number = $request->number;
            $newAddress->complement = $request->complement;
            $newAddress->reference = $request->reference;
            $newAddress->save();
        }

        return redirect()->back()->with(['status' => ['text' => 'Endereço atualizado!', 'icon' => 'success']]);
    }

    public function removeAccount(Request $request)
    {
        $valid = Validator::make($request->all(), ['password' => 'required']);
        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $user = User::find(Auth::user()->id);

        if($user->access_level === 1 || $user->access_level === "1") {
            return redirect()->back()->with(['status' => ['text' => 'Admin não pode ser removido!', 'icon' => 'error']]);
        }

        if(Hash::check($request->password, $user->password)) {
            Auth::logout();
            return redirect()->to('login')->with(['status' => ['text' => 'Perfil removido!', 'icon' => 'success']]);
        } else {
            return redirect()->back()->with(['status' => ['text' => 'Senha inválida!', 'icon' => 'error']]);
        }
    }

    public function changePicture(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'file' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $imageName = Auth::user()->id.'-'.Str::slug(Auth::user()->name).'.'.$request->file->extension();

        $request->file->storeAs("public/avatar/", $imageName);

        return redirect()->back()->with(['status' => ['text' => 'Foto atualizada com sucesso!', 'icon' => 'success']]);
    }
}
