<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AnswerItem;
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

        $budget = BudgetAnswered::query()->where('id', $request->answerId)->first()->toArray();
        $address = Address::query()->where('user_id', Auth::user()->id)->first()->toArray();
        $answeritem = AnswerItem::query()->where('answer_id', $request->answerId)->get()->toArray();

        foreach($answeritem as $item) {
            $push = [
                'amount' => floatval($item['price']),
                'description' => $item['item'],
                'quantity' => 1
            ];

            array_push($this->items, $push);
        }

        $data = [
            'answerId' => $budget['id'],
            'amount' => floatval($budget['amount']),
            'items' => $this->items,
            'customer' => [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email
            ],
            'ip' => $this->getIp(),
            'payments' => [
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
            ],
        ];

        return $this->pay($data);
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip();
    }

    protected function pay($payload)
    {

        // TODO: Implement payment gateway

        if($payload['payments']['credit_card']['card']['holder_name'] === Auth::user()->name) {

            $budgetController = new BudgetsController();
            $budgetController->accept($payload['answerId']);

            return redirect()->back()->with(['payment' => ['text' => 'Pagamento aprovado!', 'icon' => 'success', 'success' => true]]);
        }
        return redirect()->back()->with(['payment' => ['text' => 'Pagamento recusado!', 'icon' => 'error', 'success' => false]]);
    }

}
