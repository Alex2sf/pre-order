<x-admin-layout title="Produk" :header="'📦 Daftar Produk'" :subtitle="'Kelola produk pre-order Anda'">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-slate-500">Total: {{ $products->total() }} produk</p>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg shadow-violet-500/20 hover:shadow-violet-500/40 transition-all hover:-translate-y-0.5 text-sm">
            + Tambah Produk
        </a>
    </div>

    <div class="grid gap-4">
        @forelse($products as $product)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:shadow-md transition">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-2">
                        <h3 class="font-bold text-lg truncate">{{ $product->name }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold
                            {{ $product->status_label === 'Buka' ? 'bg-emerald-50 text-emerald-700' : ($product->status_label === 'Nonaktif' ? 'bg-slate-100 text-slate-500' : 'bg-red-50 text-red-700') }}">
                            {{ $product->status_label }}
                        </span>
                        @if(!$product->is_preorder)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold bg-blue-50 text-blue-700">Always Open</span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold bg-violet-50 text-violet-700">Pre-Order</span>
                        @endif
                    </div>
                    <p class="text-lg font-extrabold text-violet-600">Rp {{ number_format($product->base_price, 0, ',', '.') }}</p>
                    <div class="flex flex-wrap items-center gap-4 mt-2 text-xs text-slate-400">
                        @if($product->quota)
                        <span>📊 Kuota: {{ $product->total_ordered }}/{{ $product->quota }}</span>
                        @endif
                        @if($product->is_preorder && $product->po_end_date)
                        <span>📅 Tutup: {{ $product->po_end_date->format('d M Y H:i') }}</span>
                        @endif
                        <span>🏷️ {{ $product->variants_count }} varian</span>
                        <span>💳 Min DP: {{ $product->min_dp_percent }}%</span>
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <form method="POST" action="{{ route('admin.products.toggle', $product) }}">
                        @csrf
                        <button class="px-3 py-2 rounded-xl text-xs font-semibold transition {{ $product->is_active ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                            {{ $product->is_active ? '✅ Aktif' : '⏸️ Nonaktif' }}
                        </button>
                    </form>
                    <a href="{{ route('admin.products.edit', $product) }}" class="px-3 py-2 rounded-xl text-xs font-semibold bg-violet-50 text-violet-700 hover:bg-violet-100 transition">✏️ Edit</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                        @csrf @method('DELETE')
                        <button class="px-3 py-2 rounded-xl text-xs font-semibold bg-red-50 text-red-600 hover:bg-red-100 transition">🗑️</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-16 text-slate-400">
            <p class="text-5xl mb-4">📦</p>
            <p class="font-semibold text-lg">Belum ada produk</p>
            <p class="text-sm mt-1">Klik tombol "Tambah Produk" untuk memulai</p>
        </div>
        @endforelse
    </div>

    @if($products->hasPages())
    <div class="mt-6">{{ $products->links() }}</div>
    @endif
</x-admin-layout>
