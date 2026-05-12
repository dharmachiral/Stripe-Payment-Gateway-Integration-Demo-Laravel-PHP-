@extends('adminlte::page')

@section('title', 'Products')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="mb-0">Payment Demo Products</h3>

        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Product
        </a>

    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        @foreach ($products as $product)
            <div class="col-md-4 mb-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body d-flex flex-column">


                        {{-- Product Name --}}
                        <h4 class="font-weight-bold">
                            {{ $product->name }}
                        </h4>

                        {{-- Description --}}
                        <p class="text-muted flex-grow-1">
                            {{ $product->description ?? 'No Description Available' }}
                        </p>

                        {{-- Price --}}
                        <h3 class="text-success mb-3">
                            Rs. {{ number_format($product->price, 2) }}
                        </h3>

                        {{-- Quantity --}}
                        <p>
                            <strong>Stock:</strong>
                            {{ $product->stock }}
                        </p>

                        {{-- Status --}}
                        <p>
                            <strong>Status:</strong>

                            @if ($product->status == 'on')
                                <span class="badge badge-success">Available</span>
                            @else
                                <span class="badge badge-danger">Unavailable</span>
                            @endif
                        </p>

                        {{-- Payment Buttons --}}
                        <div class="mb-3">

                            {{-- Stripe Payment --}}
                            <a href="{{ route('checkout.page', $product->id) }}" class="btn btn-dark btn-block">
                                Buy Now
                            </a>

                            {{-- Razorpay / UPI / Wallet (Future Integration) --}}
                            <button type="button" class="btn btn-primary btn-block"
                                onclick="openRazorpay({{ $product->id }})">

                                <i class="fas fa-wallet"></i>
                                Pay with Razorpay / UPI / Wallet
                            </button>

                        </div>

                        {{-- Admin Actions --}}
                        <div class="d-flex justify-content-between mt-auto">

                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>
        @endforeach

    </div>
    <script>
        function openRazorpay(productId) {
            alert("Razorpay integration coming soon for product ID: " + productId);
        }
    </script>
@stop
