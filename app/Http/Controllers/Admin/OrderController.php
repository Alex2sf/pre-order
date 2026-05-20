<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_number', 'like', "%{$request->search}%")
                  ->orWhere('customer_name', 'like', "%{$request->search}%")
                  ->orWhere('customer_phone', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items', 'payments');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,ready,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function verifyPayment(Payment $payment)
    {
        $payment->update(['status' => 'verified']);

        // Update order paid_amount and payment_status
        $order = $payment->order;
        $totalPaid = $order->payments()->where('status', 'verified')->sum('amount');
        $order->update([
            'paid_amount' => $totalPaid,
            'payment_status' => $totalPaid >= $order->total_amount ? 'paid' : 'dp_paid',
        ]);

        return back()->with('success', 'Pembayaran berhasil diverifikasi! ✅');
    }

    public function rejectPayment(Payment $payment)
    {
        $payment->update(['status' => 'rejected']);
        return back()->with('success', 'Pembayaran ditolak.');
    }
}
