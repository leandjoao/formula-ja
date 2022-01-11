<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            'email' => 'required|email',
            'phone' => 'required',
            'cpf' => 'required|unique:users,cpf'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->cpf = $request->cpf;
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
            'name' => 'required',
            'phone' => 'required',
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $address = Address::query()->where('user_id', Auth::user()->id)->where('default', true)->first() ?? null;

        if(!is_null($address)) {
            $address->default = false;
            $address->save();
        }

        $newAddress = new Address();
        $newAddress->user_id = Auth::user()->id;
        $newAddress->name = $request->name;
        $newAddress->phone = $request->phone;
        $newAddress->cep = $request->cep;
        $newAddress->address = $request->address;
        $newAddress->neighborhood = $request->neighborhood;
        $newAddress->city = $request->city;
        $newAddress->state = $request->state;
        $newAddress->number = $request->number;
        $newAddress->default = true;
        $newAddress->complement = $request->complement;
        $newAddress->reference = $request->reference;
        $newAddress->save();


        return redirect()->back()->with(['status' => ['text' => 'Endereço atualizado!', 'icon' => 'success']]);
    }

    public function removeAddress($id)
    {
        $address = Address::query()->where('id', $id)->first();
        if(!is_null($address) && ($address->user_id == Auth::user()->id)) {
            $address->delete();

            $address = Address::query()->where('user_id', Auth::user()->id)->latest()->first();
            $address->default = true;
            $address->save();

            return redirect()->back()->with(['status' => ['text' => 'Endereço removido!', 'icon' => 'success']]);
        } else {
            return redirect()->back()->with(['status' => ['text' => 'Você não tem permissão para isso', 'icon' => 'error']]);
        }
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

        $imageName = Str::random(32).'.'.$request->file->extension();

        $request->file->storeAs("public/avatar/", $imageName);

        $user = User::find(Auth::user()->id);
        Storage::delete('public/avatar/'.$user->avatar);
        $user->avatar = $imageName;
        $user->save();

        return redirect()->back()->with(['status' => ['text' => 'Foto atualizada com sucesso!', 'icon' => 'success']]);
    }
}
