<?php
namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')
            ->where('payment_status', 'paid')
            ->latest()
            ->get();

        return view('backend.orders.index', compact('orders'));
    }
}