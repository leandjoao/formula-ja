<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PartnersController extends Controller
{
    public function index()
    {
        $this->adminAccess();
        $partners = Pharmacy::query()->count();

        return view('admin.parceiros.listing', compact('partners'));
    }

    public function showProfile()
    {
        $pharmacy = Pharmacy::query()->where('owner_id', Auth::user()->id)->first()->toArray();

        return view('admin.parceiros.profile', compact('pharmacy'));
    }

    public function update(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'pet' => 'required',
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $partner = Pharmacy::query()->where('owner_id', Auth::user()->id)->first();
        $partner->name = $request->name;
        $partner->phone = $request->phone;
        $partner->pet = boolval($request->pet);
        $partner->save();

        return redirect()->back()->with(['status' => ['text' => 'Informações alteradas!', 'icon' => 'success']]);
    }

    public function changeAddress(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'address' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'number' => 'required',
            'cep' => 'required',
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $partner = Pharmacy::query()->where('owner_id', Auth::user()->id)->first();
        $partner->zipCode = $request->cep;
        $partner->street = $request->address;
        $partner->neighborhood = $request->neighborhood;
        $partner->city = $request->city;
        $partner->state = $request->state;
        $partner->number = (int)$request->number;
        $partner->save();

        return redirect()->back()->with(['status' => ['text' => 'Informações alteradas!', 'icon' => 'success']]);
    }

    public function changeLogo(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'file' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $storage = Storage::disk('local');
        $file = $request->file('file');
        $filename = Str::random(32).'.'.Str::lower($file->getClientOriginalExtension());
        $storagePath = 'public/partners/'.$filename;
        $storage->put($storagePath, file_get_contents($file));

        $partner = Pharmacy::query()->where('owner_id', Auth::user()->id)->first();
        Storage::delete('public/partners/'.$partner->logo);
        $partner->logo = $filename;
        $partner->save();


        return redirect()->back()->with(['status' => ['text' => 'Logo atualizada com sucesso!', 'icon' => 'success']]);
    }

    public function remove($id)
    {
        $this->adminAccess();
        $partner = Pharmacy::find($id);
        Storage::delete($partner->logo);
        $partner->delete();

        return redirect()->route('partners')->with(['status' => ['text' => 'Parceiro removido!', 'icon' => 'success']]);
    }

    public function getPartners(Request $request)
    {
        $this->adminAccess();
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        $searchValue = $search_arr['value'];

        // Total records
        $totalRecords = Pharmacy::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Pharmacy::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Pharmacy::orderBy($columnName,$columnSortOrder)
        ->where('pharmacies.name', 'like', '%' .$searchValue . '%')
        ->orWhere('pharmacies.pet', 'like', '%' .$searchValue . '%')
        ->select('pharmacies.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $name = Str::ucfirst($record->name);
            $pet = boolval($record->pet);
            $logo = Storage::url($record->logo);
            $since = Carbon::parse($record->created_at)->diffForHumans();

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "pet" => $pet,
                "logo" => ["image" => $logo, "title" => $name],
                "created_at" => $since,
                "actions" => [
                    "remove" => route('partners.remove', $id),
                    ]
                );
            }

            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr
            );

            return response()->json($response);
        }
    }
