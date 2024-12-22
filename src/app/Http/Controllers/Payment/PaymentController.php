<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Controllers\Controller;
use Stripe\PaymentIntent;
use Stripe\Customer;
use Stripe\Charge;
use Exception;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function redirectToPayment()
    {
        return redirect()->route('payment.show');
    }

    public function showPaymentPage()
    {
        return view('payment.payment');
    }

    public function payment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));
            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 100,
                'currency' => 'jpy'
            ));
            return view('payment.success');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
    }
}
