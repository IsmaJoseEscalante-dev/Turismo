<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Traits\ConsumesExternalServices;

class MercadoPagoService
{
    use ConsumesExternalServices;

    protected $baseUri;

    protected $key;

    protected $secret;

    protected $baseCurrency;

    protected $converter;

    public function __construct(CurrencyConversionService $converter)
    {
        $this->baseUri = config('services.mercadopago.base_uri');
        $this->key = config('services.mercadopago.key');
        $this->secret = config('services.mercadopago.secret');
        $this->baseCurrency = config('services.mercadopago.base_currency');

        $this->converter = $converter;
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $queryParams['access_token'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        return $this->secret;
    }

    public function handlePayment(Request $request)
    {
        $request->validate([
            'card_network' => 'required',
            'card_token' => 'required',
            'email' => 'required',
            'cart_id' => 'required'
        ]);

        $cart = Cart::where('id', $request->cart_id)->firstOrFail();
        $total = $cart->cartable->amount * $cart->quantity;
        $currency = 'ars';

        $payment = $this->createPayment(
            $total,
            $currency,
            $request->card_network,
            $request->card_token,
            $request->email,
        );
        if ($payment->status === "approved") {
            $name = auth()->user()->name;
            $currency = strtoupper($currency);
            $amount = number_format($payment->transaction_amount, 0, ',', '.');

            $originalAmount = $total;
            $originalCurrency = strtoupper($currency);
            $cart->update(['status' => 'pagado']);
            Booking::create([
                'title' => $cart->cartable->name,
                'user_id' => $cart->user_id,
                'cart_id' => $cart->id,
                'type_booking' => substr($cart->cartable_type,11),
                'total' => $originalAmount,
                'date' => $cart->date
            ]);
            return redirect()
                ->route('home')
                ->withSuccess(['payment' => "Gracias, {$name}. Nosotros recibimos tus ({$amount} {$currency})."]);
        }

        return redirect()
            ->route('home')
            ->withErrors('No pudimos confirmar su pago. Por favor, inténtalo de nuevo');
    }

    public function handleApproval()
    {
        //
    }

    public function createPayment($value, $currency, $cardNetwork, $cardToken, $email, $installments = 1)
    {
        return $this->makeRequest(
            'POST',
            '/v1/payments',
            [],
            [
                'payer' => [
                    'email' => $email,
                ],
                'binary_mode' => true,
                'transaction_amount' => $value,
                'payment_method_id' => $cardNetwork,
                'token' => $cardToken,
                'installments' => $installments,
                'statement_descriptor' => config('app.name'),
            ],
            [],
            $isJsonRequest = true,
        );
    }

    public function resolveFactor($currency)
    {
        return $this->converter
            ->convertCurrency($currency, $this->baseCurrency);
    }
}
