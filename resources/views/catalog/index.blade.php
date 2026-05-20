<x-base-layout :title="$tenant->name . ' - Pre-Order'">

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-2xl border-b border-slate-200/50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between">
            <a href="{{ route('store', $tenant->slug) }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-violet-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-violet-500/25 group-hover:shadow-violet-500/40 transition-shadow duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a1.897 1.897 0 0 1-.61-1.276c-.059-.397.058-.806.344-1.12L9.22 1.61a1.68 1.68 0 0 1 2.56 0l5.743 5.343c.287.314.403.723.344 1.12a1.897 1.897 0 0 1-.61 1.276" /></svg>
                </div>
                <div>
                    <span class="font-bold text-lg text-slate-800 group-hover:text-violet-700 transition-colors">{{ $tenant->name }}</span>
                    <span class="block text-[10px] font-medium text-slate-400 tracking-wider uppercase -mt-0.5">Pre-Order Store</span>
                </div>
            </a>
            <div class="flex items-center gap-2">
                <a href="{{ route('order.track.form') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-slate-600 hover:text-violet-700 bg-slate-50 hover:bg-violet-50 rounded-xl border border-slate-200/80 hover:border-violet-200 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                    Cek Pesanan
                </a>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-violet-950 to-indigo-950 text-white">
        {{-- Animated mesh gradient blobs --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-violet-500/20 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute top-20 right-0 w-[400px] h-[400px] bg-indigo-500/15 rounded-full blur-[100px] animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute -bottom-20 left-1/3 w-[600px] h-[300px] bg-fuchsia-500/10 rounded-full blur-[100px] animate-pulse" style="animation-delay: 2s;"></div>
        </div>
        {{-- Grid pattern overlay --}}
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0wIDBoNDB2NDBoLTQweiIvPjxwYXRoIGQ9Ik00MCAwdjQwaC00MHYtNDB6IiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiIHN0cm9rZS13aWR0aD0iMSIvPjwvZz48L3N2Zz4=')] opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 relative z-10">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/10 backdrop-blur-sm text-xs font-semibold text-violet-200 mb-6">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    Menerima Pesanan
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-[1.1] tracking-tight">
                    {{ $tenant->name }}
                    <span class="block mt-1 bg-gradient-to-r from-violet-300 via-fuchsia-300 to-indigo-300 bg-clip-text text-transparent">Pre-Order</span>
                </h1>
                <p class="text-base sm:text-lg text-slate-300 mt-5 leading-relaxed max-w-lg">
                    Pesan sekarang, dapatkan nanti! Pilih produk favorit, bayar DP atau langsung lunas — kami siapkan pesananmu dengan sepenuh hati.
                </p>
                <div class="flex items-center gap-6 mt-8">
                    <div class="flex items-center gap-2 text-sm text-slate-400">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>
                        Terpercaya
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-400">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>
                        Bisa DP
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-400">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>
                        Aman
                    </div>
                </div>
            </div>
        </div>

        {{-- Gradient divider --}}
        <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-violet-500/50 to-transparent"></div>
    </section>

    {{-- Flash Messages --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl text-sm mb-4">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" /></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl text-sm mb-4">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" /></svg>
            {{ session('error') }}
        </div>
        @endif
    </div>

    {{-- Product Grid --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="flex items-end justify-between mb-10">
            <div>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-800">Produk Tersedia</h2>
                <p class="text-slate-400 mt-1 text-sm">{{ $products->total() }} produk siap dipesan</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @forelse($products as $product)
            <a href="{{ route('store.show', [$tenant->slug, $product]) }}"
               class="group relative bg-white rounded-3xl border border-slate-200/80 overflow-hidden hover:shadow-2xl hover:shadow-violet-500/10 hover:-translate-y-1.5 transition-all duration-500 ease-out">

                {{-- Image Container --}}
                <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                        {{-- Gradient overlay for readability --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-violet-500 via-indigo-500 to-purple-600 flex items-center justify-center">
                            <div class="text-center">
                                <span class="text-5xl block mb-2">{{ $product->is_preorder ? '📦' : '🛒' }}</span>
                                <span class="text-white/60 text-xs font-medium tracking-wider uppercase">{{ $product->is_preorder ? 'Pre-Order' : 'Always Open' }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- Badges --}}
                    <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                        @if($product->is_open)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-500 text-white shadow-lg shadow-emerald-500/30">
                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                            Buka
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-slate-800/80 text-white backdrop-blur-sm">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z" clip-rule="evenodd" /></svg>
                            Tutup
                        </span>
                        @endif

                        @if(!$product->is_preorder)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-white/90 text-indigo-700 backdrop-blur-sm shadow-sm">Always Open</span>
                        @endif
                    </div>

                    {{-- Quick Action Indicator --}}
                    <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                        <div class="w-10 h-10 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                        </div>
                    </div>
                </div>

                {{-- Card Content --}}
                <div class="p-5 sm:p-6">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="font-bold text-lg text-slate-800 group-hover:text-violet-700 transition-colors duration-300 line-clamp-1">{{ $product->name }}</h3>
                    </div>

                    @if($product->description)
                    <p class="text-sm text-slate-400 mt-1.5 line-clamp-2 leading-relaxed">{{ $product->description }}</p>
                    @endif

                    <div class="flex items-end justify-between mt-4">
                        <div>
                            <p class="text-xs text-slate-400 font-medium">Mulai dari</p>
                            <p class="text-2xl font-black text-slate-800 tracking-tight">Rp {{ number_format($product->base_price, 0, ',', '.') }}</p>
                        </div>
                        @if($product->min_dp_percent < 100)
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-[11px] font-bold border border-emerald-100">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg>
                            DP {{ $product->min_dp_percent }}%
                        </span>
                        @endif
                    </div>

                    {{-- Quota Progress --}}
                    @if($product->quota)
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="flex items-center justify-between text-xs mb-1.5">
                            <span class="text-slate-400 font-medium">Kuota terisi</span>
                            <span class="font-bold {{ $product->remaining_quota === 0 ? 'text-red-500' : 'text-slate-600' }}">{{ $product->total_ordered }}/{{ $product->quota }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-1000 ease-out {{ $product->remaining_quota === 0 ? 'bg-red-400' : 'bg-gradient-to-r from-violet-500 to-indigo-500' }}"
                                 style="width: {{ min(100, ($product->total_ordered / $product->quota) * 100) }}%"></div>
                        </div>
                    </div>
                    @endif

                    @if($product->is_preorder && $product->po_end_date && $product->is_open)
                    <div class="flex items-center gap-1.5 mt-3 text-xs text-amber-600 font-semibold">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        Tutup {{ $product->po_end_date->format('d M Y, H:i') }}
                    </div>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-24">
                <div class="w-20 h-20 mx-auto mb-6 rounded-3xl bg-slate-100 flex items-center justify-center">
                    <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" /></svg>
                </div>
                <p class="font-bold text-lg text-slate-500">Belum ada produk tersedia</p>
                <p class="text-sm text-slate-400 mt-1">Nantikan produk pre-order menarik dari kami!</p>
            </div>
            @endforelse
        </div>

        @if($products->hasPages())
        <div class="mt-10">{{ $products->links() }}</div>
        @endif
    </section>

    {{-- Footer --}}
    <footer class="relative bg-slate-950 text-slate-400 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute bottom-0 left-1/4 w-[400px] h-[200px] bg-violet-500/5 rounded-full blur-[80px]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-violet-600 to-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a1.897 1.897 0 0 1-.61-1.276c-.059-.397.058-.806.344-1.12L9.22 1.61a1.68 1.68 0 0 1 2.56 0l5.743 5.343c.287.314.403.723.344 1.12a1.897 1.897 0 0 1-.61 1.276" /></svg>
                    </div>
                    <span class="text-sm font-semibold text-slate-500">{{ $tenant->name }}</span>
                </div>
                <p class="text-xs text-slate-500">&copy; {{ date('Y') }} {{ $tenant->name }}. Powered by PreOrder System.</p>
            </div>
        </div>
    </footer>

</x-base-layout>
