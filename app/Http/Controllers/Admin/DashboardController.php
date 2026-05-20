<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Tenant;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTenants = Tenant::count();
        $activeTenants = Tenant::where('status', 'active')->count();
        $totalUsers = User::where('role', 'owner')->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $pendingPayments = Payment::where('status', 'pending')->count();

        $recentTenants = Tenant::withCount('products', 'orders', 'users')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalTenants', 'activeTenants', 'totalUsers', 'totalProducts',
            'totalOrders', 'totalRevenue', 'pendingPayments', 'recentTenants'
        ));
    }
}
