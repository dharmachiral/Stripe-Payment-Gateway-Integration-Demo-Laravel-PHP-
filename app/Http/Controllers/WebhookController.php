<?php

namespace App\Http\Controllers;
   use Stripe\Webhook;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class WebhookController extends Controller
{


public function handle(Request $request)
{
    $payload = $request->getContent();
    $sigHeader = $request->header('Stripe-Signature');

    try {
        $event = Webhook::constructEvent(
            $payload,
            $sigHeader,
            config('services.stripe.webhook_secret')
        );
    } catch (\Exception $e) {
        return response('Invalid signature', 400);
    }

    if ($event->type === 'checkout.session.completed') {
        // Mark order as paid
    }

    return response('Webhook received', 200);
}

}
