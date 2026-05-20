<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private function tenantId(): int
    {
        return Auth::user()->tenant_id;
    }

    public function index(Request $request)
    {
        $query = Order::where('tenant_id', $this->tenantId())->with('items');

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
        return view('owner.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_if((int) $order->tenant_id !== $this->tenantId(), 403);
        $order->load('items', 'payments');
        return view('owner.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        abort_if((int) $order->tenant_id !== $this->tenantId(), 403);

        $request->validate([
            'status' => 'required|in:pending,processing,ready,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function verifyPayment(Payment $payment)
    {
        $order = $payment->order;
        abort_if((int) $order->tenant_id !== $this->tenantId(), 403);

        $payment->update(['status' => 'verified']);

        $totalPaid = $order->payments()->where('status', 'verified')->sum('amount');
        $order->update([
            'paid_amount' => $totalPaid,
            'payment_status' => $totalPaid >= $order->total_amount ? 'paid' : 'dp_paid',
        ]);

        return back()->with('success', 'Pembayaran berhasil diverifikasi! ✅');
    }

    public function rejectPayment(Payment $payment)
    {
        $order = $payment->order;
        abort_if((int) $order->tenant_id !== $this->tenantId(), 403);

        $payment->update(['status' => 'rejected']);
        return back()->with('success', 'Pembayaran ditolak.');
    }
}
