<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resolvers\PaymentPlatformResolver;

class PaymentController extends Controller
{
    protected $paymentPlatformResolver;

    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->middleware('auth');

        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }

    public function pay(Request $request)
    {
        $request->validate([
            '_token' => 'required',
            'email' => 'required|email',
            'card_network' => 'required',
            'card_token' => 'required',
            'payment_platform' => 'required|exists:App\Models\PaymentPlatform,id'
        ]);

        $paymentPlatform = $this->paymentPlatformResolver
            ->resolveService($request->payment_platform);

        session()->put('paymentPlatformId', $request->payment_platform);

        return $paymentPlatform->handlePayment($request);
    }

    public function approval()
    {
        if (session()->has('paymentPlatformId')) {
            $paymentPlatform = $this->paymentPlatformResolver
                ->resolveService(session()->get('paymentPlatformId'));

            return $paymentPlatform->handleApproval();
        }

        return redirect()
            ->route('home')
            ->withErrors('We cannot retrieve your payment platform. Try again, plase.');
    }

    public function cancelled()
    {
        return redirect()
            ->route('home')
            ->withErrors('You cancelled the payment');
    }
}
