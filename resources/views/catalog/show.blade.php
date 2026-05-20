<x-base-layout :title="$product->name . ' - ' . $tenant->name">
    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-2xl border-b border-slate-200/50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between">
            <a href="{{ route('store', $tenant->slug) }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-violet-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-violet-500/25">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a1.897 1.897 0 0 1-.61-1.276c-.059-.397.058-.806.344-1.12L9.22 1.61a1.68 1.68 0 0 1 2.56 0l5.743 5.343c.287.314.403.723.344 1.12a1.897 1.897 0 0 1-.61 1.276" /></svg>
                </div>
                <div>
                    <span class="font-bold text-lg text-slate-800">{{ $tenant->name }}</span>
                    <span class="block text-[10px] font-medium text-slate-400 tracking-wider uppercase -mt-0.5">Pre-Order Store</span>
                </div>
            </a>
            <div class="flex items-center gap-2">
                <a href="{{ route('store', $tenant->slug) }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-slate-600 hover:text-violet-700 bg-slate-50 hover:bg-violet-50 rounded-xl border border-slate-200/80 hover:border-violet-200 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                    Kembali
                </a>
                <a href="{{ route('order.track.form') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-slate-600 hover:text-violet-700 bg-slate-50 hover:bg-violet-50 rounded-xl border border-slate-200/80 hover:border-violet-200 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                    Cek Pesanan
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14" x-data="productOrder()">
        @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl text-sm mb-6">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" /></svg>
            {{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl text-sm mb-6">
            <ul class="list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-10">
            {{-- Left: Product Info --}}
            <div class="lg:col-span-3 space-y-6">
                {{-- Image Banner --}}
                <div class="relative aspect-[4/3] sm:aspect-[16/10] rounded-3xl overflow-hidden border border-slate-200/80 shadow-lg shadow-slate-200/50 bg-slate-100">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-violet-500 via-indigo-500 to-purple-600 flex items-center justify-center">
                            <span class="text-8xl sm:text-9xl">{{ $product->is_preorder ? '📦' : '🛒' }}</span>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4 flex flex-col gap-1.5">
                        @if($product->is_open)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500 text-white shadow-lg shadow-emerald-500/30">
                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> Buka
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-800/80 text-white backdrop-blur-sm">Tutup</span>
                        @endif
                    </div>
                </div>

                {{-- Product Info Card --}}
                <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold {{ $product->is_preorder ? 'bg-violet-100 text-violet-700' : 'bg-blue-100 text-blue-700' }}">{{ $product->is_preorder ? 'Pre-Order' : 'Always Open' }}</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight">{{ $product->name }}</h1>
                    <p class="text-3xl sm:text-4xl font-black bg-gradient-to-r from-violet-600 to-indigo-600 bg-clip-text text-transparent mt-3">Rp {{ number_format($product->base_price, 0, ',', '.') }}</p>

                    @if($product->description)
                    <p class="text-slate-500 leading-relaxed mt-4 text-sm sm:text-base">{{ $product->description }}</p>
                    @endif

                    {{-- Info Pills --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6">
                        @if($product->estimated_delivery_days)
                        <div class="p-3 rounded-2xl bg-amber-50 border border-amber-100">
                            <p class="text-[10px] uppercase tracking-wider text-amber-500 font-bold">Estimasi</p>
                            <p class="font-bold text-amber-700 mt-0.5">{{ $product->estimated_delivery_days }} hari</p>
                        </div>
                        @endif
                        @if($product->min_dp_percent < 100)
                        <div class="p-3 rounded-2xl bg-emerald-50 border border-emerald-100">
                            <p class="text-[10px] uppercase tracking-wider text-emerald-500 font-bold">Min DP</p>
                            <p class="font-bold text-emerald-700 mt-0.5">{{ $product->min_dp_percent }}%</p>
                        </div>
                        @endif
                        @if($product->quota)
                        <div class="p-3 rounded-2xl bg-slate-50 border border-slate-100">
                            <p class="text-[10px] uppercase tracking-wider text-slate-400 font-bold">Sisa Kuota</p>
                            <p class="font-bold {{ $product->remaining_quota === 0 ? 'text-red-600' : 'text-slate-700' }} mt-0.5">{{ $product->remaining_quota ?? '∞' }} / {{ $product->quota }}</p>
                        </div>
                        @endif
                    </div>

                    @if($product->is_preorder && $product->po_end_date && $product->is_open)
                    <div class="mt-4 p-4 rounded-2xl bg-amber-50 border border-amber-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        <p class="text-sm font-semibold text-amber-700">PO tutup pada: {{ $product->po_end_date->format('d M Y, H:i') }}</p>
                    </div>
                    @endif

                    {{-- Variants --}}
                    @if($product->variants->count())
                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <h3 class="font-bold text-slate-700 mb-3">Pilih Varian</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" @click="selectedVariant = null" :class="selectedVariant === null ? 'ring-2 ring-violet-500 bg-violet-50 border-violet-200' : 'bg-slate-50 border-slate-200 hover:bg-slate-100'" class="p-3 rounded-2xl text-sm font-semibold transition-all text-left border">
                                <p class="text-slate-700">Standar</p>
                                <p class="text-xs text-slate-400 mt-0.5">Rp {{ number_format($product->base_price, 0, ',', '.') }}</p>
                            </button>
                            @foreach($product->variants as $variant)
                            <button type="button" @click="selectedVariant = {{ $variant->id }}" :class="selectedVariant === {{ $variant->id }} ? 'ring-2 ring-violet-500 bg-violet-50 border-violet-200' : 'bg-slate-50 border-slate-200 hover:bg-slate-100'" class="p-3 rounded-2xl text-sm font-semibold transition-all text-left border">
                                <p class="text-slate-700">{{ $variant->name }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">Rp {{ number_format($variant->final_price, 0, ',', '.') }}</p>
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Right: Order Form --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-7 sticky top-24">
                    <h3 class="font-black text-lg text-slate-800 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-violet-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" /></svg>
                        Pesan Sekarang
                    </h3>

                    @if(!$product->is_open)
                    <div class="text-center py-10 text-slate-400">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-slate-100 flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                        </div>
                        <p class="font-bold text-slate-500">Pre-Order Ditutup</p>
                        <p class="text-sm mt-1">Nantikan batch selanjutnya!</p>
                    </div>
                    @elseif($product->remaining_quota === 0)
                    <div class="text-center py-10 text-slate-400">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-red-50 flex items-center justify-center">
                            <svg class="w-8 h-8 text-red-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                        </div>
                        <p class="font-bold text-slate-500">Kuota Habis</p>
                        <p class="text-sm mt-1">Semua slot sudah terisi</p>
                    </div>
                    @else
                    <form method="POST" action="{{ route('store.checkout', $tenant->slug) }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="items[0][product_id]" value="{{ $product->id }}">
                        <input type="hidden" name="items[0][variant_id]" :value="selectedVariant">

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                            <input type="text" name="customer_name" required value="{{ old('customer_name') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition bg-slate-50/50" placeholder="Nama Anda">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">No. WhatsApp *</label>
                            <input type="text" name="customer_phone" required value="{{ old('customer_phone') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition bg-slate-50/50" placeholder="08xxxxxxxxxx">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Alamat (opsional)</label>
                            <textarea name="customer_address" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition bg-slate-50/50" placeholder="Alamat pengiriman...">{{ old('customer_address') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Jumlah *</label>
                            <input type="number" name="items[0][quantity]" x-model.number="quantity" required min="1" max="{{ $product->remaining_quota ?? 9999 }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition bg-slate-50/50" placeholder="1">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Catatan</label>
                            <textarea name="notes" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition bg-slate-50/50" placeholder="Catatan khusus...">{{ old('notes') }}</textarea>
                        </div>

                        <div class="border-t border-slate-100 pt-4 mt-2">
                            <div class="flex justify-between items-baseline">
                                <span class="text-sm font-semibold text-slate-500">Total</span>
                                <span class="text-2xl font-black text-slate-800" x-text="'Rp ' + numberFormat(totalPrice)"></span>
                            </div>
                            @if($product->min_dp_percent < 100)
                            <p class="text-xs text-emerald-600 mt-1 font-semibold">💳 Min DP: <span x-text="'Rp ' + numberFormat(Math.ceil(totalPrice * {{ $product->min_dp_percent }} / 100))"></span> ({{ $product->min_dp_percent }}%)</p>
                            @endif
                        </div>

                        <button type="submit" class="w-full py-4 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-bold rounded-2xl shadow-lg shadow-violet-500/30 hover:shadow-violet-500/50 transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 text-sm">
                            Pesan Sekarang →
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-slate-950 text-slate-500 text-sm text-center py-10">
        <p>&copy; {{ date('Y') }} {{ $tenant->name }}. Powered by PreOrder System.</p>
    </footer>

    <script>
    function productOrder() {
        const basePrice = {{ $product->base_price }};
        const variants = {!! $product->variants->mapWithKeys(fn($v) => [$v->id => $v->final_price])->toJson() !!};
        return {
            selectedVariant: null,
            quantity: 1,
            get unitPrice() { return (this.selectedVariant && variants[this.selectedVariant]) ? variants[this.selectedVariant] : basePrice; },
            get totalPrice() { return this.unitPrice * this.quantity; },
            numberFormat(num) { return new Intl.NumberFormat('id-ID').format(num); }
        };
    }
    </script>
</x-base-layout>
