<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Mail\NewBudget;
use App\Models\Address;
use App\Models\Budget;
use App\Models\Pharmacy;
use App\Models\Upload;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        return view('guest.enviarReceita', compact(['sm' => $this->SocialMedia(),'cta' => $this->CTA(),'how' => $this->HIW()]));
    }

    public function pet()
    {
        return view('guest.enviarReceita', compact(['sm' => $this->SocialMedia(),'cta' => $this->CTA(),'how' => $this->HIW()]));
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

        $user = User::query()->where('email', $request->email)->with('address')->first()->toArray();

        if(!$user) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->phone);
            $user->access_level = 2;
            $user->phone = $request->phone;
            $user->save();

            $address = new Address();
            $address->user_id = $user['id'];
            $address->cep = $request->zipCode;
            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->address = $request->street;
            $address->neighborhood = $request->neighborhood;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->number = $request->number;
            $address->default = isset($request->sameInfo);
            $address->complement = $request->complement ?? '';
            $address->reference = $request->reference ?? '';
            $address->save();

            if(!isset($request->sameInfo)) {
                $address = new Address();
                $address->user_id = $user['id'];
                $address->cep = $request->shippingZipCode;
                $address->name = $request->shippingName;
                $address->phone = $request->shippingPhone;
                $address->address = $request->shippingStreet;
                $address->neighborhood = $request->shippingNeighborhood;
                $address->city = $request->shippingCity;
                $address->state = $request->shippingState;
                $address->number = $request->shippingNumber;
                $address->default = true;
                $address->complement = $request->shippingComplement ?? '';
                $address->reference = $request->shippingReference ?? '';
                $address->save();
            }
        }

        if(empty($user['address'])) {
            $address = new Address();
            $address->user_id = $user['id'];
            $address->cep = $request->zipCode;
            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->address = $request->street;
            $address->neighborhood = $request->neighborhood;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->number = $request->number;
            $address->default = isset($request->sameInfo);
            $address->complement = $request->complement ?? '';
            $address->reference = $request->reference ?? '';
            $address->save();

            if(!isset($request->sameInfo)) {
                $address = new Address();
                $address->user_id = $user['id'];
                $address->cep = $request->zipCode;
                $address->name = $request->shippingName;
                $address->phone = $request->shippingPhone;
                $address->address = $request->shippingStreet;
                $address->neighborhood = $request->shippingNeighborhood;
                $address->city = $request->shippingCity;
                $address->state = $request->shippingState;
                $address->number = $request->shippingNumber;
                $address->default = true;
                $address->complement = $request->shippingComplement ?? '';
                $address->reference = $request->shippingReference ?? '';
                $address->save();
            }
        }

        $fileName = Str::random(64) .'.'. $request->file->extension();
        $request->file->storeAs("public/uploads/", $fileName);

        $upload = new Upload();
        $upload->file = $fileName;
        $upload->user_id = $user['id'];
        $upload->save();

        $budget = new Budget();
        $budget->upload_id = $upload->id;
        $budget->user_id = $user['id'];
        $budget->sendToAddress = $request['defaultAddress'] ?? $address->id;
        $budget->pet = boolval($request->pet);
        $budget->save();

        if(!isset($request->sameInfo)) {
            $addr = $request->shippingStreet.', '.$request->shippingNumber.', '.$request->shippingNeighborhood.' - '.$request->shippingCity.'/'.$request->shippingState;
        } else {
            $addr = $request->street.', '.$request->number.', '.$request->neighborhood.' - '.$request->city.'/'.$request->state;
        }

        $mail = [
            'name' => $request->name,
            'date' => Carbon::now()->format('d/m/Y H:m'),
            'file' => $fileName,
            'address' => $addr,
        ];

        $parceiros = Pharmacy::query()->with('owner')->get()->toArray();
        foreach($parceiros as $parceiro) {
            Mail::to($parceiro['owner']['email'])->send(new NewBudget($mail));
        }

        return redirect()->route('budgets')->with(['status' => ['text' => 'Recebemos a sua receita!', 'icon' => 'success']]);
    }

    public function changeAddress($id)
    {
        $address = Address::query()->where('user_id', Auth::user()->id)->where('default', true)->first();
        $address->default = false;
        $address->save();

        $address = Address::query()->where('user_id', Auth::user()->id)->where('id', $id)->first();
        $address->default = true;
        $address->save();

        return response()->json(['status' => ['text' => 'Endereço alterado!', 'icon' => 'success']]);
    }
}
