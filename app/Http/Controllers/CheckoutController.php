<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Order;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;


class CheckoutController extends Controller
{


public function checkout(Request $request)
{
    $request->validate([
        'product_id' => 'required',
        'customer_name' => 'required',
        'email' => 'required|email',
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($request->product_id);
    $quantity = $request->quantity;
    $total = $product->price * $quantity;

    Stripe::setApiKey(env('STRIPE_SECRET'));

    $paymentIntent = PaymentIntent::create([
        'amount' => $total * 100,
        'currency' => 'usd',
        'payment_method_types' => ['card'],
    ]);

    $order = Order::create([
        'customer_name' => $request->customer_name,
        'email' => $request->email,
        'product_id' => $product->id,
        'quantity' => $quantity,
        'amount' => $total,
        'stripe_payment_intent' => $paymentIntent->id,
        'payment_status' => 'pending',
    ]);

    return view('checkout_payment', [
        'product' => $product,
        'order' => $order,
        'clientSecret' => $paymentIntent->client_secret,
        'stripeKey' => env('STRIPE_KEY'),
    ]);
}

  public function success(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $paymentIntentId = $request->payment_intent;

    if (!$paymentIntentId) {
        return redirect('/')->with('error', 'Payment reference missing');
    }

    $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

    $order = Order::where('stripe_payment_intent', $paymentIntent->id)->first();

    if ($order && $paymentIntent->status == 'succeeded') {

        $order->payment_status = 'paid';
        $order->save();

        $product = Product::find($order->product_id);

        if ($product) {
            $product->stock -= $order->quantity;
            $product->save();
        }
    }

    return view('success', compact('order'));
}

    public function cancel()
    {
        return view('cancel');
    }

    public function showCheckout($id)
{
    $product = Product::findOrFail($id);

    return view('checkout', compact('product'));
}
}