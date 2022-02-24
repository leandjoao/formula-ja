<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagarmeController extends Controller
{
    protected $PAGARME;
    protected $HEADER;

    public function __construct()
    {
        $this->PAGARME = new Client(['base_uri' => config('app.pagarme.url'), 'verify' => false]);
        $this->HEADER = [
            'Authorization' => 'Basic ' . base64_encode(config('app.pagarme.sk').':'.config('app.pagarme.pk')),
            'Content-Type' => 'application/json'
        ];
    }

    public function newRecipient($body)
    {
        $payload = [
            'headers' => $this->HEADER,
            'json' => [
                'name' => $body['name'],
                'email' => $body['email'],
                'description' => 'Criado via Plataforma',
                'document' => str_replace('-', '', str_replace('.', '', str_replace('/', '', $body['cpf']))),
                'type' => 'individual',
                'default_bank_account' => [
                    'holder_name' => $body['name'],
                    'holder_type' => 'individual',
                    'holder_document' => str_replace('-', '', str_replace('.', '', str_replace('/', '', $body['cpf']))),
                    'bank' => $body['cod_bank'],
                    'branch_number' => $body['branch'],
                    'branch_check_digit' => $body['branch_check'],
                    'account_number' => $body['account_number'],
                    'account_check_digit' => $body['account_digit'],
                    'type' => 'checking',
                    'metadata' => [
                        "user_cpf" => $body['owner'],
                    ],
                ],
                'transfer_settings' => [
                    'transfer_enabled' => true,
                    'transfer_interval' => 'Daily',
                    'transfer_day' => 0
                ],
                'automatic_anticipation_settings' => [
                    'enabled' => false,
                ],
            ],
        ];

        $response = $this->PAGARME->post('recipients', $payload);
        return json_decode($response->getBody());

    }

    protected function allRecipients($page = 1, $size = 10)
    {
        $header = ['headers' => $this->HEADER];
        $response = $this->PAGARME->get('recipients?page='.$page. '&size='.$size, $header);
        $recipients = json_decode($response->getBody());

        return $recipients;
    }

    public function checkout($data)
    {
        $payload = [
            'headers' => $this->HEADER,
            'json' => $data,
        ];

        $response = $this->PAGARME->post('orders', $payload);
        return json_decode($response->getBody());
    }

    public function getBalance($recipient_id)
    {
        try {
            $response = $this->PAGARME->get('recipients/'.$recipient_id.'/balance', ['headers' => $this->HEADER]);
            return json_decode($response->getBody());
        } catch (\Throwable $th) {
            return null;
        }

    }

    public function getOrderStatus($order_id)
    {
        try {
            $response = $this->PAGARME->get('orders/'.$order_id, ['headers' => $this->HEADER]);
            return json_decode($response->getBody());
        } catch (\Throwable $th) {
            return null;
        }
    }
}
