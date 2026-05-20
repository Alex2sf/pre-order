<x-owner-layout title="Dashboard" :header="'📊 Dashboard'" :subtitle="'Ringkasan bisnis Pre-Order Anda'">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Produk Aktif</p>
            <p class="text-3xl font-extrabold text-slate-800 mt-1">{{ $activeProducts }}</p>
            <p class="text-xs text-slate-400 mt-1">dari {{ $totalProducts }} produk</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Order Hari Ini</p>
            <p class="text-3xl font-extrabold text-violet-600 mt-1">{{ $todayOrders }}</p>
            <p class="text-xs text-slate-400 mt-1">{{ $pendingOrders }} menunggu proses</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Pendapatan Hari Ini</p>
            <p class="text-3xl font-extrabold text-emerald-600 mt-1">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Pendapatan Bulan Ini</p>
            <p class="text-3xl font-extrabold text-indigo-600 mt-1">Rp {{ number_format($monthRevenue, 0, ',', '.') }}</p>
            @if($pendingPayments > 0)
            <p class="text-xs text-amber-500 mt-1 font-semibold">⚠️ {{ $pendingPayments }} pembayaran pending</p>
            @endif
        </div>
    </div>

    {{-- Store Link --}}
    <div class="bg-gradient-to-r from-violet-600 to-indigo-600 rounded-2xl p-6 text-white mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-bold text-lg">🌐 Link Toko Online Anda</h3>
                <p class="text-violet-200 text-sm mt-1">Bagikan link ini ke pelanggan agar mereka bisa langsung pre-order</p>
                <p class="font-mono bg-white/20 px-3 py-1.5 rounded-lg mt-2 text-sm inline-block">{{ url('/store/' . Auth::user()->tenant->slug) }}</p>
            </div>
            <button onclick="navigator.clipboard.writeText('{{ url('/store/' . Auth::user()->tenant->slug) }}'); this.textContent='✅ Copied!'; setTimeout(() => this.textContent='📋 Copy', 2000)" class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-xl text-sm font-semibold transition">📋 Copy</button>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-lg">🛒 Pesanan Terbaru</h3>
            <a href="{{ route('owner.orders.index') }}" class="text-sm text-violet-600 font-medium hover:text-violet-500 transition">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Invoice</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Pelanggan</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Total</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Bayar</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-3 font-mono font-semibold text-violet-600"><a href="{{ route('owner.orders.show', $order) }}">{{ $order->invoice_number }}</a></td>
                        <td class="px-6 py-3">{{ $order->customer_name }}</td>
                        <td class="px-6 py-3 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $order->payment_status === 'paid' ? 'bg-emerald-50 text-emerald-700' : ($order->payment_status === 'dp_paid' ? 'bg-amber-50 text-amber-700' : 'bg-slate-100 text-slate-600') }}">
                                {{ $order->payment_status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $order->status === 'completed' ? 'bg-emerald-50 text-emerald-700' : ($order->status === 'cancelled' ? 'bg-red-50 text-red-700' : 'bg-violet-50 text-violet-700') }}">
                                {{ $order->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-slate-400 text-xs">{{ $order->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-12 text-slate-400">Belum ada pesanan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-owner-layout>
