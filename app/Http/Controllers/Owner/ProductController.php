<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private function tenantId(): int
    {
        return Auth::user()->tenant_id;
    }

    public function index()
    {
        $products = Product::where('tenant_id', $this->tenantId())->withCount('variants')->latest()->paginate(20);
        return view('owner.products.index', compact('products'));
    }

    public function create()
    {
        return view('owner.products.form');
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
            'quota' => 'nullable|integer|min:1',
            'min_dp_percent' => 'required|integer|min:1|max:100',
        ]);

        Product::create([
            'tenant_id' => $this->tenantId(),
            ...$request->only([
                'name', 'description', 'base_price',
                'is_preorder', 'po_start_date', 'po_end_date',
                'estimated_delivery_days', 'quota', 'min_dp_percent',
            ]),
        ]);

        return redirect()->route('owner.products.index')->with('success', 'Produk berhasil ditambahkan! 🎉');
    }

    public function edit(Product $product)
    {
        abort_if((int) $product->tenant_id !== $this->tenantId(), 403);
        $product->load('variants');
        return view('owner.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        abort_if((int) $product->tenant_id !== $this->tenantId(), 403);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'is_preorder' => 'boolean',
            'po_start_date' => 'nullable|date',
            'po_end_date' => 'nullable|date|after_or_equal:po_start_date',
            'estimated_delivery_days' => 'nullable|integer|min:1',
            'quota' => 'nullable|integer|min:1',
            'min_dp_percent' => 'required|integer|min:1|max:100',
        ]);

        $product->update($request->only([
            'name', 'description', 'base_price',
            'is_preorder', 'po_start_date', 'po_end_date',
            'estimated_delivery_days', 'quota', 'min_dp_percent',
        ]));

        return redirect()->route('owner.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        abort_if((int) $product->tenant_id !== $this->tenantId(), 403);
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }

    public function toggleActive(Product $product)
    {
        abort_if((int) $product->tenant_id !== $this->tenantId(), 403);
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', 'Status produk berhasil diubah!');
    }

    public function storeVariant(Request $request, Product $product)
    {
        abort_if((int) $product->tenant_id !== $this->tenantId(), 403);
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
        abort_if((int) $variant->product->tenant_id !== $this->tenantId(), 403);
        $variant->delete();
        return back()->with('success', 'Varian berhasil dihapus!');
    }
}
