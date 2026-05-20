<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private function tenantId(): int
    {
        return Auth::user()->tenant_id;
    }

    public function index()
    {
        $tid = $this->tenantId();
        $today = today();

        $totalProducts = Product::where('tenant_id', $tid)->count();
        $activeProducts = Product::where('tenant_id', $tid)->where('is_active', true)->count();
        $totalOrders = Order::where('tenant_id', $tid)->count();
        $pendingOrders = Order::where('tenant_id', $tid)->whereIn('status', ['pending', 'processing'])->count();
        $todayOrders = Order::where('tenant_id', $tid)->whereDate('created_at', $today)->count();
        $todayRevenue = Order::where('tenant_id', $tid)->whereDate('created_at', $today)->where('payment_status', 'paid')->sum('total_amount');
        $monthRevenue = Order::where('tenant_id', $tid)->whereMonth('created_at', $today->month)->whereYear('created_at', $today->year)->where('payment_status', 'paid')->sum('total_amount');
        $pendingPayments = Payment::whereHas('order', fn($q) => $q->where('tenant_id', $tid))->where('status', 'pending')->count();

        $recentOrders = Order::where('tenant_id', $tid)->with('items')->latest()->take(10)->get();

        return view('owner.dashboard', compact(
            'totalProducts', 'activeProducts', 'totalOrders', 'pendingOrders',
            'todayOrders', 'todayRevenue', 'monthRevenue', 'pendingPayments', 'recentOrders'
        ));
    }
}
