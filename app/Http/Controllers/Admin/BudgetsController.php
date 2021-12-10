<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnswerItem;
use App\Models\Budget;
use App\Models\BudgetAnswered;
use App\Models\Pharmacy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BudgetsController extends Controller
{
    public function index()
    {
        $orcamentos = Budget::query()->count();
        return view('admin.budgets.listing', compact('orcamentos'));
    }

    public function inner($id)
    {
        $budget = Budget::query()
        ->find($id)
        ->with(['file', 'sender', 'answers', 'address'])
        ->first()
        ->toArray();



        return view('admin.budgets.inner', compact('budget'));
    }

    public function accept($id)
    {
        $budgetAnswer = BudgetAnswered::query()->where('id', $id)->with('budget')->first();
        $budgetAnswer->accepted = true;
        $budgetAnswer->save();

        $budget = Budget::query()->where('id', $budgetAnswer['budget']['id'])->first();
        $budget->status = 'aguardando';
        $budget->save();

        BudgetAnswered::query()->where('id', 'not like', $id)->delete();

        return redirect()->back()->with(['status' => ['text' => 'Orçamento aceito!', 'icon' => 'success']]);
    }

    public function sendBudget(Request $request)
    {
        $answer = new BudgetAnswered();
        $answer->budget_id = $request->budget_id;
        $answer->user_id = $request->user_id;
        $answer->answered_by = Pharmacy::query()->where('owner_id', Auth::user()->id)->first()->id;
        $answer->description = $request->description;
        $answer->save();

        foreach($request->answer as $itemList) {
            $item = new AnswerItem();
            $item->budget_id = $request->budget_id;
            $item->partner_id = Pharmacy::query()->where('owner_id', Auth::user()->id)->first()->id;
            $item->answer_id = $answer->id;
            $item->item = $itemList['item'];
            $item->price = $itemList['price'];
            $item->save();
        }

        return response()->json(['text' => 'Resposta salva!', 'icon' => 'success', 'redirect' => route('budgets')], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $budget = Budget::query()->where('id', $id)->first();
        $budget->status = $request->status;
        $budget->save();

        return redirect()->back()->with(['status' => ['text' => 'Status alterado!', 'icon' => 'success']]);
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
        $totalRecordswithFilter = Budget::select('count(*) as allcount')->where('id', 'like', '%' .$searchValue . '%')->count();

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
