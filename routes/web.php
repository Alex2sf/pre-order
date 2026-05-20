<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboard;
use App\Http\Controllers\Owner\ProductController;
use App\Http\Controllers\Owner\OrderController;
use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

// ============================================================
// Landing → Login
// ============================================================
Route::get('/', fn() => redirect()->route('login'));

// ============================================================
// AUTH ROUTES
// ============================================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================================================
// SUPER ADMIN ROUTES
// ============================================================
Route::prefix('admin')->middleware(['auth', 'role:super_admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('tenants', [TenantController::class, 'index'])->name('tenants.index');
    Route::post('tenants/{tenant}/toggle', [TenantController::class, 'toggleStatus'])->name('tenants.toggle');
});

// ============================================================
// OWNER ROUTES
// ============================================================
Route::prefix('owner')->middleware(['auth', 'role:owner', 'tenant.access'])->name('owner.')->group(function () {
    Route::get('/', [OwnerDashboard::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', ProductController::class)->except('show');
    Route::post('products/{product}/toggle', [ProductController::class, 'toggleActive'])->name('products.toggle');
    Route::post('products/{product}/variants', [ProductController::class, 'storeVariant'])->name('products.variants.store');
    Route::delete('variants/{variant}', [ProductController::class, 'destroyVariant'])->name('variants.destroy');

    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::post('payments/{payment}/verify', [OrderController::class, 'verifyPayment'])->name('payments.verify');
    Route::post('payments/{payment}/reject', [OrderController::class, 'rejectPayment'])->name('payments.reject');
});

// ============================================================
// PUBLIC STOREFRONT (per-tenant)
// ============================================================
Route::get('/store/{slug}', [CatalogController::class, 'index'])->name('store');
Route::get('/store/{slug}/{product}', [CatalogController::class, 'show'])->name('store.show');
Route::post('/store/{slug}/checkout', [CatalogController::class, 'checkout'])->name('store.checkout');

// Order Tracking (global)
Route::get('/track', [CatalogController::class, 'trackForm'])->name('order.track.form');
Route::get('/track/{invoice}', [CatalogController::class, 'track'])->name('order.track');
Route::post('/track/{order}/payment', [CatalogController::class, 'uploadPayment'])->name('order.payment');
