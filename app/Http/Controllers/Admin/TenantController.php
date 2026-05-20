<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::withCount('products', 'orders', 'users')->latest()->paginate(20);
        return view('admin.tenants.index', compact('tenants'));
    }

    public function toggleStatus(Tenant $tenant)
    {
        $tenant->update(['status' => $tenant->status === 'active' ? 'inactive' : 'active']);
        return back()->with('success', 'Status tenant berhasil diubah!');
    }
}
