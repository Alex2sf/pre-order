<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    /**
     * Public storefront for a specific tenant.
     */
    public function index(string $slug)
    {
        $tenant = Tenant::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $products = Product::where('tenant_id', $tenant->id)->where('is_active', true)->with('variants')->latest()->get();

        return view('catalog.index', compact('tenant', 'products'));
    }

    /**
     * Product detail page.
     */
    public function show(string $slug, Product $product)
    {
        $tenant = Tenant::where('slug', $slug)->where('status', 'active')->firstOrFail();
        abort_if((int) $product->tenant_id !== $tenant->id || !$product->is_active, 404);
        $product->load('variants');
        return view('catalog.show', compact('tenant', 'product'));
    }

    /**
     * Process checkout (Guest checkout).
     */
    public function checkout(Request $request, string $slug)
    {
        $tenant = Tenant::where('slug', $slug)->where('status', 'active')->firstOrFail();

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'nullable|string',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.variant_id' => 'nullable|exists:product_variants,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($request, $tenant) {
            $subtotal = 0;
            $itemsData = [];

            foreach ($request->items as $item) {
                $product = Product::where('tenant_id', $tenant->id)->findOrFail($item['product_id']);
                abort_if(!$product->is_open, 422, 'Produk ini sudah tutup PO.');

                if ($product->remaining_quota !== null && $item['quantity'] > $product->remaining_quota) {
                    abort(422, "Kuota produk {$product->name} tidak cukup.");
                }

                $price = (float) $product->base_price;
                $variantName = null;

                if (!empty($item['variant_id'])) {
                    $variant = $product->variants()->findOrFail($item['variant_id']);
                    $price = $variant->final_price;
                    $variantName = $variant->name;
                }

                $itemSubtotal = $price * $item['quantity'];
                $subtotal += $itemSubtotal;

                $itemsData[] = [
                    'product_id' => $product->id,
                    'product_variant_id' => $item['variant_id'] ?? null,
                    'product_name' => $product->name,
                    'variant_name' => $variantName,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'subtotal' => $itemSubtotal,
                ];
            }

            $order = Order::create([
                'tenant_id' => $tenant->id,
                'invoice_number' => Order::generateInvoice(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'subtotal' => $subtotal,
                'total_amount' => $subtotal,
                'notes' => $request->notes,
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            foreach ($itemsData as $itemData) {
                $order->items()->create($itemData);
            }

            return redirect()->route('order.track', $order->invoice_number)
                ->with('success', 'Pesanan berhasil dibuat! Invoice: ' . $order->invoice_number);
        });
    }

    /**
     * Track order by invoice number.
     */
    public function trackForm()
    {
        return view('catalog.track');
    }

    public function track(string $invoice)
    {
        $order = Order::where('invoice_number', $invoice)->with('items', 'payments', 'tenant')->firstOrFail();
        return view('catalog.track-result', compact('order'));
    }

    /**
     * Upload payment proof.
     */
    public function uploadPayment(Request $request, Order $order)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'payment_method' => 'required|string|max:100',
            'payment_proof' => 'required|image|max:2048',
            'type' => 'required|in:dp,pelunasan,full',
        ]);

        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        $order->payments()->create([
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_proof' => $path,
            'type' => $request->type,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil dikirim! Menunggu verifikasi. ⏳');
    }
}
