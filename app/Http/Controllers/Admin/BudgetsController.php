<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnswerItem;
use App\Models\Budget;
use App\Models\BudgetAnswered;
use App\Models\Payment;
use App\Models\Pharmacy;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetsController extends Controller
{
    public function index()
    {
        $orcamentos = ['answered' => [], 'new' => []];
        if(Auth::user()->access_level == 1) {
            $orcamentos['answered'] = Budget::query()->where('status_id', 'not like',1)->paginate(10);
            $orcamentos['new'] = Budget::query()->where('status_id', 1)->paginate(10);

        } else if(Auth::user()->access_level == 3) {
            $budgets = Budget::query()->with(['sender','answers','status'])->get()->toArray();

            foreach($budgets as $budget) {
                foreach ($budget['answers'] as $answers) {
                    if(Auth::user()->pharmacy->id == (int)$answers['answered_by']) {
                        array_push($orcamentos['answered'], $budget);
                    }
                }
            }

            $orcamentos['new'] = Budget::query()->with(['sender', 'status'])->where('status_id', 1)->orWhere('status_id', 2)->get()->toArray();

        } else {
            $orcamentos['answered'] = Budget::query()->with(['sender', 'status'])->where('user_id', Auth::user()->id)->where('status_id', 'not like', 1)->paginate(10);
            $orcamentos['new'] = Budget::query()->with(['sender', 'status'])->where('user_id', Auth::user()->id)->where('status_id', 'like', 1)->paginate(10);
        }

        return view('admin.budgets.listing', compact('orcamentos'));
    }

    public function inner($id, Request $request)
    {
        $answersId = [];
        $payment = null;

        $budget = Budget::query()
        ->where('id', $id)
        ->with(['file', 'sender', 'answers', 'address', 'status'])
        ->first()
        ->toArray();

        $status = Status::all()->toArray();
        foreach($budget['answers'] as $answer) {
            if(!empty($answer['payment'])) {
                $this->updatePayment($answer);
            }
            array_push($answersId, $answer['id']);
        }

        if($budget['status_id'] == 1 || $budget['status_id'] == 2 || Auth::user()->access_level == 1 || Auth::user()->access_level == 2 && Auth::user()->id == $budget['user_id'] || Auth::user()->access_level == 3 && (in_array(Auth::user()->pharmacy->id, $answersId, true))) {
            return view('admin.budgets.inner', compact('budget', 'status'));
        } else {
            return abort(403);
        }
    }

    public function sendBudget(Request $request)
    {
        $amount = 0;

        foreach($request->answer as $itemList) {
            $amount += floatval($itemList['price']);
        }

        $budget = Budget::query()->where('id', $request->budget_id)->first();
        $budget->status_id = 2;
        $budget->save();

        $answer = new BudgetAnswered();
        $answer->budget_id = $request->budget_id;
        $answer->user_id = $request->user_id;
        $answer->answered_by = Pharmacy::query()->where('owner_id', Auth::user()->id)->first()->id;
        $answer->description = $request->description;
        $answer->amount = $amount;
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
        $budget->status_id = $request->status;
        $budget->save();

        return redirect()->back()->with(['status' => ['text' => 'Status alterado!', 'icon' => 'success']]);
    }

    protected function updatePayment($answer)
    {
        $paymentStatus = new PagarmeController();
        $payment = $paymentStatus->getOrderStatus($answer['payment']['code']);

        if($payment->status == 'paid') {
            $budgetAnswer = BudgetAnswered::query()->where('id', $answer['id'])->first();
            $budgetAnswer->accepted = true;
            $budgetAnswer->order_id = $payment->id;
            $budgetAnswer->save();

            $budgets = Budget::query()->where('id', $answer['budget_id'])->first();
            $budgets->status_id = 3;
            $budgets->save();

            $updatePayment = Payment::query()->where('id', $answer['payment']['id'])->first();
            $updatePayment->status = $payment->status;
            $updatePayment->save();

            return true;
        }

        return false;
    }
}
