<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function showCreate()
    {
        $this->adminAccess();
        return view('admin.parceiros.create');
    }

    public function create(Request $request)
    {
        $this->adminAccess();
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:partners,name',
            'pet' => 'required',
            'logo' => 'required|file|max:1048|mimes:png,jpg,jpeg'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $storage = Storage::disk('local');
        $file = $request->file('logo');
        $filename = Str::random(32).'.'.Str::lower($file->getClientOriginalExtension());

        $storagePath = 'public/partners/'.$filename;

        $partner = new Pharmacy();
        $partner->name = $request->name;
        $partner->street = $request->street;
        $partner->neighborhood = $request->neighborhood;
        $partner->city = $request->city;
        $partner->state = $request->state;
        $partner->number = (int)$request->number;
        $partner->phone = $request->phone;
        $partner->owner_id = $request->owner_id;
        $partner->pet = boolval($request->pet);
        $partner->logo = $storagePath;
        $partner->save();

        $storage->put($storagePath, file_get_contents($file));

        return redirect()->back()->with(['status' => ['text' => 'Parceiro criado!', 'icon' => 'success']]);
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
