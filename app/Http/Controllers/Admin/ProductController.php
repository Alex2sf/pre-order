<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withCount('variants')->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'is_preorder' => 'boolean',
            'po_start_date' => 'nullable|date',
            'po_end_date' => 'nullable|date|after_or_equal:po_start_date',
            'estimated_delivery_days' => 'nullable|integer|min:1',
            'estimated_delivery_date' => 'nullable|date',
            'quota' => 'nullable|integer|min:1',
            'min_dp_percent' => 'required|integer|min:1|max:100',
        ]);

        $product = Product::create($request->only([
            'name', 'description', 'base_price',
            'is_preorder', 'po_start_date', 'po_end_date',
            'estimated_delivery_days', 'estimated_delivery_date',
            'quota', 'min_dp_percent',
        ]));

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan! 🎉');
    }

    public function edit(Product $product)
    {
        $product->load('variants');
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'is_preorder' => 'boolean',
            'po_start_date' => 'nullable|date',
            'po_end_date' => 'nullable|date|after_or_equal:po_start_date',
            'estimated_delivery_days' => 'nullable|integer|min:1',
            'estimated_delivery_date' => 'nullable|date',
            'quota' => 'nullable|integer|min:1',
            'min_dp_percent' => 'required|integer|min:1|max:100',
        ]);

        $product->update($request->only([
            'name', 'description', 'base_price',
            'is_preorder', 'po_start_date', 'po_end_date',
            'estimated_delivery_days', 'estimated_delivery_date',
            'quota', 'min_dp_percent',
        ]));

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }

    public function toggleActive(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', 'Status produk berhasil diubah!');
    }

    // === Variant Management ===

    public function storeVariant(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_adjustment' => 'required|numeric',
            'quota' => 'nullable|integer|min:1',
        ]);

        $product->variants()->create($request->only('name', 'price_adjustment', 'quota'));
        return back()->with('success', 'Varian berhasil ditambahkan!');
    }

    public function destroyVariant(ProductVariant $variant)
    {
        $variant->delete();
        return back()->with('success', 'Varian berhasil dihapus!');
    }
}
