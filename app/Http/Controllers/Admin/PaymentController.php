<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AnswerItem;
use App\Models\Budget;
use App\Models\BudgetAnswered;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $items = [];
    protected $mock = true;

    public function index($budgetId)
    {
        $budget = BudgetAnswered::query()->with(['items', 'info', 'budget', 'payment'])->where('id', $budgetId)->first()->toArray();
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

        $splitRule = [
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
        ];

        switch ($request->payMethod) {
            case 'credit_card':
                $payments = [
                    [
                        'payment_method' => 'credit_card',
                        'credit_card' => $this->creditCard($request, $address),
                        'split' => $splitRule
                    ],
                ];
                break;

        case 'pix':
            $payments = [
                [
                    'payment_method' => 'pix',
                    'pix' => [
                        'expires_in' => 600
                    ],
                    'split' => $splitRule
                ],
            ];
            break;
        }

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
            'payments' => $payments
        ];


        if($this->mock) {
            $payment = response(json_encode([
                'id' => 'or_5bZEAgXIBSpX89vK',
                'status' => 'pending',
                'charges' => [
                    [
                        'last_transaction' => [
                            'qr_code' => "00020101021226480019BR.COM.STONE.QRCODE0108A37F8712020912345678927820 014BR.GOV.BCB.PIX2560sandbox-qrcode.stone.com.br/api/v2/qr/sGY7FyVExavqkzFvkQu MXA28580010BR.COM.ELO0104516002151234567890000000308933BB1100401P520400 00530398654041.005802BR5911STONE TESTE6009SAO PAULO62600522sGY7FyVExavqkzFvkQuMXA50300017BR.GOV.BCB.BRCODE01051.0.0 80500010BR.COM.ELO01100915132023020200030201040613202363043BA1",
                            'qr_code_url' => asset('images/qrcode.png')
                        ]
                    ]
                ]
            ]));

            $payment = json_decode($payment->original);
        } else {
            $pay = new PagarmeController();
            $payment = $pay->checkout($data);
        }


        if($payment->status == "pending" && $request->payMethod == "pix") {

            return redirect()->back()->with(['pix' => ['qr_code' => $payment->charges[0]->last_transaction->qr_code, 'qr_image' => $payment->charges[0]->last_transaction->qr_code_url, 'code' => $payment->id]]);
        }

        if($payment->status == "paid") {

            $budgetAnswer = BudgetAnswered::query()->where('id', $request->answerId)->with('budget')->first();
            $budgetAnswer->accepted = true;
            $budgetAnswer->order_id = $payment->id;
            $budgetAnswer->save();

            $budget = Budget::query()->where('id', $budgetAnswer['budget']['id'])->first();
            $budget->status_id = 3;
            $budget->save();

            BudgetAnswered::query()->where('id', 'not like', $request->answerId)->delete();

            $this->paymentMethod($request->answerId, $request->payMethod, $payment->status, $budget['amount'], $payment->id);

            return redirect()->back()->with(['payment' => ['text' => 'Pagamento aprovado!', 'icon' => 'success', 'success' => true]]);
        }

        return redirect()->back()->with(['payment' => ['text' => 'Pagamento recusado!', 'icon' => 'error', 'message' => explode(' | ', $payment->charges[0]->last_transaction->gateway_response->errors[0]->message)[2], 'success' => false]]);
    }

    protected function creditCard($request, $address)
    {
        return [
            'installments' => (int)$request['installments'],
            'card' => [
                'number' => str_replace(' ', '', $request['number']),
                'cvv' => $request['cvv'],
                'exp_month' => (int)$request['exp_month'],
                'exp_year' => (int)$request['exp_year'],
                'holder_name' => $request['holder_name'],
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
        ];
    }

    protected function paymentMethod($id, $method, $status, $amount, $code = null)
    {
        $payment = new Payment();
        $payment->method = $method;
        $payment->answer_id = $id;
        $payment->user_id = Auth::user()->id;
        $payment->amount = floatval($amount);
        $payment->status = $status;
        $payment->code = $code;
        $payment->save();

        return true;
    }

    public function confirmPix(Request $request)
    {
        $this->paymentMethod($request->answer_id, "pix", "pending", $request->amount, $request->code);
        return redirect()->back()->with(['payment' => ['text' => 'Aguardando confimação de pagamento!', 'icon' => 'success', 'success' => true]]);
    }
}
