<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\User;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BudgetsController extends Controller
{
    public function index(Generator $faker)
    {
        $orcamentos = Budget::query()->count();
        return view('admin.budgets.listing', compact('orcamentos'));
    }

    public function inner($id)
    {
        $budget = Budget::query()
        ->where('id', $id)
        ->with(['file', 'sender', 'answers'])
        ->first()
        ->toArray();

        return view('admin.budgets.inner', compact('budget'));
    }

    public function accept($id)
    {
        return 'ok';
    }

    public function sendBudget(Request $request)
    {
        dd($request->all());
    }

    public function getBudgets(Request $request)
    {
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
        $totalRecords = Budget::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Budget::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Budget::orderBy($columnName,$columnSortOrder)
        ->where('budgets.status', 'like', '%' .$searchValue . '%')
        ->orWhere('budgets.id', 'like', '%' .$searchValue . '%')
        ->select('budgets.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $name = Str::ucfirst(User::query()->where('id', $record->user_id)->first()['name']);
            $status = $record->status;
            $pet = boolval($record->pet);
            $created = Carbon::parse($record->created_at)->diffForHumans();

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "status" => $status,
                "pet" => $pet,
                "created_at" => $created,
                "actions" => [
                    "remove" => route('partners.remove', $id),
                    "view" => route('budgets.inner', $id)
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

    public function getBudgetsUser(Request $request)
    {
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
        $totalRecords = Budget::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Budget::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Budget::orderBy($columnName,$columnSortOrder)
        ->where('budgets.user_id', 'like', Auth::user()->id)
        ->orWhere('budgets.status', 'like', '%' .$searchValue . '%')
        ->orWhere('budgets.id', 'like', '%' .$searchValue . '%')
        ->select('budgets.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $name = Str::ucfirst(User::query()->where('id', $record->user_id)->first()['name']);
            $status = $record->status;
            $pet = boolval($record->pet);
            $created = Carbon::parse($record->created_at)->diffForHumans();

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "status" => $status,
                "pet" => $pet,
                "created_at" => $created,
                "actions" => [
                    "remove" => route('partners.remove', $id),
                    "view" => route('budgets.inner', $id)
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
