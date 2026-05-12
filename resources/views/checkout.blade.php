@extends('adminlte::page')

@section('title', 'Secure Checkout')

@section('content')

<div class="container-fluid">

    <div class="row">

        <!-- LEFT SIDE -->
        <div class="col-lg-8 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center mb-4">

                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                             style="width:45px;height:45px;font-size:20px;">

                            <i class="fas fa-lock"></i>

                        </div>

                        <div class="ml-3">

                            <h3 class="mb-0 font-weight-bold">
                                Secure Checkout
                            </h3>

                            <small class="text-muted">
                                SSL secured payment powered by Stripe
                            </small>

                        </div>

                    </div>

                    <form method="POST" action="{{ route('checkout') }}">
                        @csrf

                        <input type="hidden"
                               name="product_id"
                               value="{{ $product->id }}">

                        <!-- CUSTOMER INFO -->

                        <h5 class="mb-3 font-weight-bold">
                            Customer Information
                        </h5>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Full Name</label>

                                    <input type="text"
                                           name="customer_name"
                                           class="form-control form-control-lg"
                                           required>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Email Address</label>

                                    <input type="email"
                                           name="email"
                                           class="form-control form-control-lg"
                                           required>

                                </div>

                            </div>

                        </div>

                        <hr>

                        <!-- PRODUCT -->

                        <h5 class="mb-3 font-weight-bold">
                            Order Details
                        </h5>

                        <div class="d-flex align-items-center border rounded p-3 mb-4">

                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                 style="width:80px;height:80px;">

                                <i class="fas fa-box fa-2x text-secondary"></i>

                            </div>

                            <div class="ml-3 flex-grow-1">

                                <h5 class="mb-1">
                                    {{ $product->name }}
                                </h5>

                                <p class="text-muted mb-1">
                                    {{ $product->description }}
                                </p>

                                <small class="text-success">
                                    In Stock:
                                    {{ $product->stock }}
                                </small>

                            </div>

                            <div class="text-right">

                                <h4 class="text-success font-weight-bold">
                                    Rs.
                                    {{ number_format($product->price,2) }}
                                </h4>

                            </div>

                        </div>

                        <!-- QUANTITY -->

                        <div class="form-group">

                            <label class="font-weight-bold">
                                Quantity
                            </label>

                            <div class="d-flex align-items-center">

                                <button type="button"
                                        class="btn btn-light border"
                                        id="minusBtn">

                                    -

                                </button>

                                <input type="number"
                                       name="quantity"
                                       id="qty"
                                       value="1"
                                       min="1"
                                       max="{{ $product->stock }}"
                                       class="form-control text-center mx-2"
                                       style="max-width:120px;">

                                <button type="button"
                                        class="btn btn-light border"
                                        id="plusBtn">

                                    +

                                </button>

                            </div>

                        </div>

                        <!-- PAYMENT BUTTON -->

                        <button class="btn btn-dark btn-lg btn-block mt-4">

                            <i class="fas fa-credit-card"></i>

                            Proceed to Secure Payment

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h4 class="font-weight-bold mb-4">
                        Order Summary
                    </h4>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Product</span>

                        <strong>
                            {{ $product->name }}
                        </strong>

                    </div>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Price</span>

                        <strong>
                            Rs.
                            {{ number_format($product->price,2) }}
                        </strong>

                    </div>

                    <div class="d-flex justify-content-between mb-3">

                        <span>Quantity</span>

                        <strong id="qtyText">
                            1
                        </strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">

                        <span>Subtotal</span>

                        <strong id="subtotal">
                            Rs. {{ number_format($product->price,2) }}
                        </strong>

                    </div>

                    <div class="d-flex justify-content-between mb-2">

                        <span>Tax</span>

                        <strong>
                            Rs. 0.00
                        </strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <h5 class="font-weight-bold">
                            Total
                        </h5>

                        <h4 class="text-success font-weight-bold">

                            Rs.
                            <span id="totalPrice">
                                {{ number_format($product->price,2) }}
                            </span>

                        </h4>

                    </div>

                    <div class="mt-4">

                        <div class="alert alert-light border">

                            <i class="fas fa-shield-alt text-success"></i>

                            Secure checkout with Stripe SSL encryption.

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

let qtyInput = document.getElementById('qty');

let price = {{ $product->price }};

function updateTotal(){

    let qty = parseInt(qtyInput.value);

    if(qty < 1){
        qty = 1;
        qtyInput.value = 1;
    }

    document.getElementById('qtyText').innerText = qty;

    let total = price * qty;

    document.getElementById('subtotal').innerText =
        'Rs. ' + total.toFixed(2);

    document.getElementById('totalPrice').innerText =
        total.toFixed(2);
}

qtyInput.addEventListener('input', updateTotal);

document.getElementById('plusBtn').addEventListener('click', function(){

    qtyInput.value =
        parseInt(qtyInput.value) + 1;

    updateTotal();

});

document.getElementById('minusBtn').addEventListener('click', function(){

    if(parseInt(qtyInput.value) > 1){

        qtyInput.value =
            parseInt(qtyInput.value) - 1;

        updateTotal();
    }

});

</script>

@stop