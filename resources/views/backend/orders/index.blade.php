@extends('adminlte::page')

@section('title', 'Paid Orders')

@section('content')

<div class="container mt-4">

    <!-- STATS -->
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6>Total Orders</h6>
                    <h3>{{ $orders->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6>Total Revenue</h6>
                    <h3>
                        Rs {{ number_format($orders->sum('amount'),2) }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6>Paid Orders</h6>
                    <h3>{{ $orders->where('payment_status','paid')->count() }}</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">

        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Paid Orders</h4>
        </div>

        <div class="card-body p-0">

            <table class="table table-hover mb-0">

                <thead class="bg-light">

                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($orders as $key => $order)

                    <tr>

                        <td>{{ $key+1 }}</td>

                        <td>
                            <strong>{{ $order->customer_name }}</strong><br>
                            <small class="text-muted">{{ $order->email }}</small>
                        </td>

                        <td>{{ $order->product->name ?? 'N/A' }}</td>

                        <td>{{ $order->quantity }}</td>

                        <td><strong>Rs {{ number_format($order->amount,2) }}</strong></td>

                        <td>
                            <span class="badge badge-success">
                                Paid
                            </span>
                        </td>

                        <td>{{ $order->created_at->format('d M Y') }}</td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center p-4">
                            No orders found
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection