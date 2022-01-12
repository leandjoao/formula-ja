<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AnswerItem;
use App\Models\Budget;
use App\Models\BudgetAnswered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $items = [];
    
    public function index($budgetId)
    {
        $budget = BudgetAnswered::query()->with(['items', 'info'])->where('id', $budgetId)->first()->toArray();
        return view('admin.payment.index', compact('budget'));
    }

    public function checkout(Request $request)
    {
        $budget = BudgetAnswered::query()->with('info')->where('id', $request->answerId)->first()->toArray();
        $address = Address::query()->where('user_id', Auth::user()->id)->first()->toArray();
        $answeritem = AnswerItem::query()->where('answer_id', $request->answerId)->get()->toArray();

        foreach($answeritem as $item) {
            $push = [
                'amount' => floatval($item['price']) * 100,
                'description' => $item['item'],
                'quantity' => 1,
                'code' => 'order_id:'.$budget['id'],
            ];

            array_push($this->items, $push);
        }

        $phone = explode(' ', Auth::user()->phone);
        $ddd = str_replace('(', '', str_replace(')', '', $phone[0]));
        $number = str_replace('-', '', str_replace(' ', '', $phone[1]));

        $data = [
            'answerId' => $budget['id'],
            'amount' => floatval($budget['amount']) * 100,
            'items' => $this->items,
            'customer' => [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'document' => str_replace('.', '', str_replace('-', '', Auth::user()->cpf)),
                'type' => 'individual',
                'phones' => [
                    'home_phone' => [
                        'country_code' => '55',
                        'number' => $number,
                        'area_code' => $ddd,
                    ],
                ],
            ],
            'payments' => [
                [
                    'payment_method' => 'credit_card',
                    'credit_card' => [
                        'installments' => 1,
                        'card' => [
                            'number' => str_replace(' ', '', $request->number),
                            'cvv' => $request->cvv,
                            'exp_month' => (int)$request->exp_month,
                            'exp_year' => (int)$request->exp_year,
                            'holder_name' => $request->holder_name,
                            'billing_address' => [
                                'street' => $address['address'],
                                'number' => $address['number'],
                                'zip_code' => str_replace('-', '', $address['cep']),
                                'neighborhood' => $address['neighborhood'],
                                'complement' => $address['complement'],
                                'city' => $address['city'],
                                'state' => $address['state'],
                                'country' => 'BR',
                            ],
                        ],
                    ],
                    'split' => [
                        [
                            'amount' => config('app.pagarme.tax_ammount'),
                            'recipient_id' => config('app.pagarme.rp'),
                            'type' => 'percentage',
                            "options" => [
                                "charge_processing_fee" => false,
                                "charge_remainder_fee" => false,
                                "liable" => true
                            ],
                        ],
                        [
                            'amount' => 100 - config('app.pagarme.tax_ammount'),
                            'recipient_id' => $budget['info']['recipient_id'],
                            'type' => 'percentage',
                            "options" => [
                                "charge_processing_fee" => true,
                                "charge_remainder_fee" => true,
                                "liable" => true
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $pay = new PagarmeController();
        $payment = $pay->checkout($data);

        if($payment->status != "paid") {

            return redirect()->back()->with(['payment' => ['text' => 'Pagamento recusado!', 'icon' => 'error', 'message' => explode(' | ', $payment->charges[0]->last_transaction->gateway_response->errors[0]->message)[2], 'success' => false]]);
        } else {
            $budgetAnswer = BudgetAnswered::query()->where('id', $request->answerId)->with('budget')->first();
            $budgetAnswer->accepted = true;
            $budgetAnswer->order_id = $payment->id;
            $budgetAnswer->save();

            $budget = Budget::query()->where('id', $budgetAnswer['budget']['id'])->first();
            $budget->status_id = 3;
            $budget->save();

            BudgetAnswered::query()->where('id', 'not like', $request->answerId)->delete();

            return redirect()->back()->with(['payment' => ['text' => 'Pagamento aprovado!', 'icon' => 'success', 'success' => true]]);
        }
    }
}
