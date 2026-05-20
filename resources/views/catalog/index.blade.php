<x-base-layout :title="$tenant->name . ' - Pre-Order'">
    {{-- Navbar --}}
    <nav class="sticky top-0 z-40 bg-white/80 backdrop-blur-xl border-b border-slate-200/80">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <a href="{{ route('store', $tenant->slug) }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-lg font-black text-white">P</div>
                <span class="font-bold text-xl text-slate-800">{{ $tenant->name }}</span>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('order.track.form') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-violet-600 transition">📋 Cek Pesanan</a>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-violet-600 via-indigo-600 to-purple-700 text-white">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-20 w-96 h-96 bg-violet-300 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-20 relative z-10">
            <h1 class="text-4xl sm:text-5xl font-black leading-tight mb-4">{{ $tenant->name }}<br><span class="text-violet-200">Pre-Order</span></h1>
            <p class="text-lg text-violet-100 max-w-lg">Pesan sekarang, dapatkan nanti! Pilih produk, bayar DP atau langsung lunas, dan kami siapkan pesananmu.</p>
        </div>
    </section>

    {{-- Flash Messages --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 pt-6">
        @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4">{{ session('error') }}</div>
        @endif
    </div>

    {{-- Product Grid --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 py-12">
        <h2 class="text-2xl font-bold mb-8">🔥 Produk Tersedia</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
            <a href="{{ route('store.show', [$tenant->slug, $product]) }}" class="group bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                {{-- Card Header / Color Banner --}}
                <div class="h-40 bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center relative">
                    <span class="text-6xl">{{ $product->is_preorder ? '📦' : '🛒' }}</span>

                    {{-- Status Badge --}}
                    <div class="absolute top-3 right-3">
                        @if($product->is_open)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-400/90 text-white shadow-sm">✅ Buka</span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-400/90 text-white shadow-sm">🔒 Tutup</span>
                        @endif
                    </div>

                    {{-- Type Badge --}}
                    <div class="absolute top-3 left-3">
                        @if(!$product->is_preorder)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-white/20 text-white backdrop-blur-sm">Always Open</span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-white/20 text-white backdrop-blur-sm">Pre-Order</span>
                        @endif
                    </div>
                </div>

                <div class="p-5">
                    <h3 class="font-bold text-lg group-hover:text-violet-600 transition">{{ $product->name }}</h3>
                    @if($product->description)
                    <p class="text-sm text-slate-400 mt-1 line-clamp-2">{{ $product->description }}</p>
                    @endif

                    <p class="text-2xl font-extrabold text-violet-600 mt-3">Rp {{ number_format($product->base_price, 0, ',', '.') }}</p>

                    <div class="flex flex-wrap items-center gap-3 mt-3 text-xs text-slate-400">
                        @if($product->quota)
                        <div class="flex-1">
                            <div class="flex justify-between mb-1">
                                <span>Kuota</span>
                                <span class="font-semibold {{ $product->remaining_quota === 0 ? 'text-red-500' : 'text-emerald-600' }}">{{ $product->total_ordered }}/{{ $product->quota }}</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                <div class="bg-gradient-to-r from-violet-500 to-indigo-500 h-1.5 rounded-full transition-all" style="width: {{ min(100, ($product->total_ordered / $product->quota) * 100) }}%"></div>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($product->is_preorder && $product->po_end_date && $product->is_open)
                    <p class="text-xs text-amber-600 font-semibold mt-3">⏰ Tutup: {{ $product->po_end_date->format('d M Y, H:i') }}</p>
                    @endif

                    @if($product->min_dp_percent < 100)
                    <p class="text-xs text-emerald-600 font-semibold mt-1">💳 Bisa DP {{ $product->min_dp_percent }}%!</p>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-20 text-slate-400">
                <p class="text-5xl mb-4">📦</p>
                <p class="font-semibold text-lg">Belum ada produk tersedia</p>
                <p class="text-sm mt-1">Nantikan produk pre-order menarik dari kami!</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-slate-900 text-slate-400 text-sm text-center py-8 mt-12">
        <p>&copy; {{ date('Y') }} PreOrder. Semua hak dilindungi.</p>
    </footer>
</x-base-layout>
