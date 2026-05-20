<x-base-layout :title="$product->name . ' - ' . $tenant->name">
    {{-- Navbar --}}
    <nav class="sticky top-0 z-40 bg-white/80 backdrop-blur-xl border-b border-slate-200/80">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <a href="{{ route('store', $tenant->slug) }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-lg font-black text-white">P</div>
                <span class="font-bold text-xl text-slate-800">{{ $tenant->name }}</span>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('store', $tenant->slug) }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-violet-600 transition">← Kembali</a>
                <a href="{{ route('order.track.form') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-violet-600 transition">📋 Cek Pesanan</a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-12" x-data="productOrder()">
        @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm mb-6">{{ session('success') }}</div>
        @endif

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            {{-- Left: Product Info --}}
            <div class="lg:col-span-3 space-y-6">
                {{-- Banner --}}
                <div class="h-56 bg-gradient-to-br from-violet-500 to-indigo-600 rounded-3xl flex items-center justify-center relative overflow-hidden">
                    <span class="text-8xl">{{ $product->is_preorder ? '📦' : '🛒' }}</span>
                    <div class="absolute top-4 right-4 flex items-center gap-2">
                        @if($product->is_open)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-400/90 text-white">✅ Buka</span>
                        @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-400/90 text-white">🔒 Tutup</span>
                        @endif
                    </div>
                </div>

                {{-- Info --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <h1 class="text-3xl font-black text-slate-800 mb-2">{{ $product->name }}</h1>
                    <p class="text-3xl font-extrabold text-violet-600 mb-4">Rp {{ number_format($product->base_price, 0, ',', '.') }}</p>

                    @if($product->description)
                    <p class="text-slate-500 leading-relaxed">{{ $product->description }}</p>
                    @endif

                    <div class="grid grid-cols-2 gap-4 mt-6 text-sm">
                        @if($product->is_preorder)
                        <div class="p-3 rounded-xl bg-violet-50">
                            <p class="text-xs text-violet-400 font-medium">Mode</p>
                            <p class="font-semibold text-violet-700">Pre-Order</p>
                        </div>
                        @else
                        <div class="p-3 rounded-xl bg-blue-50">
                            <p class="text-xs text-blue-400 font-medium">Mode</p>
                            <p class="font-semibold text-blue-700">Always Open</p>
                        </div>
                        @endif

                        @if($product->estimated_delivery_days)
                        <div class="p-3 rounded-xl bg-amber-50">
                            <p class="text-xs text-amber-400 font-medium">Estimasi</p>
                            <p class="font-semibold text-amber-700">{{ $product->estimated_delivery_days }} hari</p>
                        </div>
                        @endif

                        @if($product->min_dp_percent < 100)
                        <div class="p-3 rounded-xl bg-emerald-50">
                            <p class="text-xs text-emerald-400 font-medium">Min DP</p>
                            <p class="font-semibold text-emerald-700">{{ $product->min_dp_percent }}%</p>
                        </div>
                        @endif

                        @if($product->quota)
                        <div class="p-3 rounded-xl bg-slate-50">
                            <p class="text-xs text-slate-400 font-medium">Kuota Tersisa</p>
                            <p class="font-semibold {{ $product->remaining_quota === 0 ? 'text-red-600' : 'text-slate-700' }}">{{ $product->remaining_quota ?? '∞' }} / {{ $product->quota }}</p>
                        </div>
                        @endif
                    </div>

                    @if($product->is_preorder && $product->po_end_date && $product->is_open)
                    <div class="mt-4 p-4 rounded-xl bg-amber-50 border border-amber-100">
                        <p class="text-sm font-semibold text-amber-700">⏰ PO tutup pada: {{ $product->po_end_date->format('d M Y, H:i') }}</p>
                    </div>
                    @endif

                    {{-- Variants --}}
                    @if($product->variants->count())
                    <div class="mt-6">
                        <h3 class="font-bold mb-3">🏷️ Pilih Varian</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" @click="selectedVariant = null" :class="selectedVariant === null ? 'ring-2 ring-violet-500 bg-violet-50' : 'bg-slate-50 hover:bg-slate-100'" class="p-3 rounded-xl text-sm font-semibold transition text-left">
                                <p>Standar</p>
                                <p class="text-xs text-slate-400 mt-1">Rp {{ number_format($product->base_price, 0, ',', '.') }}</p>
                            </button>
                            @foreach($product->variants as $variant)
                            <button type="button" @click="selectedVariant = {{ $variant->id }}" :class="selectedVariant === {{ $variant->id }} ? 'ring-2 ring-violet-500 bg-violet-50' : 'bg-slate-50 hover:bg-slate-100'" class="p-3 rounded-xl text-sm font-semibold transition text-left">
                                <p>{{ $variant->name }}</p>
                                <p class="text-xs text-slate-400 mt-1">Rp {{ number_format($variant->final_price, 0, ',', '.') }}</p>
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Right: Order Form --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sticky top-24">
                    <h3 class="font-bold text-lg mb-4">🛒 Pesan Sekarang</h3>

                    @if(!$product->is_open)
                    <div class="text-center py-8 text-slate-400">
                        <p class="text-4xl mb-2">🔒</p>
                        <p class="font-semibold">Pre-Order Ditutup</p>
                        <p class="text-sm mt-1">Nantikan batch selanjutnya!</p>
                    </div>
                    @elseif($product->remaining_quota === 0)
                    <div class="text-center py-8 text-slate-400">
                        <p class="text-4xl mb-2">😢</p>
                        <p class="font-semibold">Kuota Habis</p>
                        <p class="text-sm mt-1">Semua slot sudah terisi</p>
                    </div>
                    @else
                    <form method="POST" action="{{ route('store.checkout', $tenant->slug) }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="items[0][product_id]" value="{{ $product->id }}">
                        <input type="hidden" name="items[0][variant_id]" :value="selectedVariant">

                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-1">Nama Lengkap *</label>
                            <input type="text" name="customer_name" required value="{{ old('customer_name') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="Nama Anda">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-1">No. WhatsApp *</label>
                            <input type="text" name="customer_phone" required value="{{ old('customer_phone') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="08xxxxxxxxxx">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-1">Alamat (opsional)</label>
                            <textarea name="customer_address" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="Alamat pengiriman...">{{ old('customer_address') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-1">Jumlah *</label>
                            <input type="number" name="items[0][quantity]" x-model.number="quantity" required min="1" max="{{ $product->remaining_quota ?? 9999 }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="1">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-1">Catatan</label>
                            <textarea name="notes" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="Catatan khusus...">{{ old('notes') }}</textarea>
                        </div>

                        {{-- Total Preview --}}
                        <div class="border-t border-slate-200 pt-4">
                            <div class="flex justify-between text-lg font-extrabold">
                                <span>Total</span>
                                <span class="text-violet-600" x-text="'Rp ' + numberFormat(totalPrice)"></span>
                            </div>
                            @if($product->min_dp_percent < 100)
                            <p class="text-xs text-emerald-600 mt-1">💳 Min DP: <span x-text="'Rp ' + numberFormat(Math.ceil(totalPrice * {{ $product->min_dp_percent }} / 100))"></span> ({{ $product->min_dp_percent }}%)</p>
                            @endif
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-violet-500/30 hover:shadow-violet-500/50 transition-all hover:-translate-y-0.5 active:translate-y-0">
                            Pesan Sekarang 🚀
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-slate-900 text-slate-400 text-sm text-center py-8 mt-12">
        <p>&copy; {{ date('Y') }} PreOrder. Semua hak dilindungi.</p>
    </footer>

    <script>
    function productOrder() {
        const basePrice = {{ $product->base_price }};
        const variants = {!! $product->variants->mapWithKeys(fn($v) => [$v->id => $v->final_price])->toJson() !!};

        return {
            selectedVariant: null,
            quantity: 1,

            get unitPrice() {
                if (this.selectedVariant && variants[this.selectedVariant]) {
                    return variants[this.selectedVariant];
                }
                return basePrice;
            },

            get totalPrice() {
                return this.unitPrice * this.quantity;
            },

            numberFormat(num) {
                return new Intl.NumberFormat('id-ID').format(num);
            }
        };
    }
    </script>
</x-base-layout>
