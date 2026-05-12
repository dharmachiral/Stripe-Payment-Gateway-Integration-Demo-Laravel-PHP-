@extends('adminlte::page')

@section('content')

<div class="container mt-5">

    <div class="card shadow-sm border-0">

        <div class="card-body p-4">

            <h3 class="mb-3">Complete Payment</h3>

            <p><strong>Product:</strong> {{ $product->name }}</p>
            <p><strong>Total:</strong> Rs {{ $order->amount }}</p>

            <form id="payment-form">

                <!-- STRIPE PAYMENT ELEMENT (BEST UX) -->
                <div id="payment-element" class="p-3 border rounded"></div>

                <button class="btn btn-dark btn-block mt-4" id="submitBtn">
                    Pay Securely
                </button>

                <div id="payment-message" class="mt-3 text-danger"></div>

            </form>

        </div>

    </div>

</div>

<script src="https://js.stripe.com/v3/"></script>

<script>

const stripe = Stripe("{{ $stripeKey }}");

const elements = stripe.elements({
    clientSecret: "{{ $clientSecret }}"
});

// 👇 Modern Stripe UI (includes country + ZIP automatically)
const paymentElement = elements.create("payment");

paymentElement.mount("#payment-element");

document.getElementById("payment-form").addEventListener("submit", async function(e){
    e.preventDefault();

    document.getElementById("submitBtn").disabled = true;

    const { error } = await stripe.confirmPayment({
    elements,
    confirmParams: {
        return_url: "{{ route('success') }}"
    }
});

    if (error) {
        document.getElementById("payment-message").innerText = error.message;
        document.getElementById("submitBtn").disabled = false;
    }

});

</script>

@endsection