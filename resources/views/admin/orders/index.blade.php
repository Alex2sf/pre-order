<x-admin-layout title="Pesanan" :header="'🛒 Daftar Pesanan'" :subtitle="'Kelola semua pesanan pre-order'">
    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 mb-6">
        <form method="GET" class="flex flex-wrap items-center gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari invoice / nama..."
                   class="flex-1 min-w-[200px] px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
            <select name="status" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>⚙️ Diproses</option>
                <option value="ready" {{ request('status') === 'ready' ? 'selected' : '' }}>📦 Siap</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>✅ Selesai</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>❌ Batal</option>
            </select>
            <select name="payment_status" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500">
                <option value="">Semua Bayar</option>
                <option value="unpaid" {{ request('payment_status') === 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                <option value="dp_paid" {{ request('payment_status') === 'dp_paid' ? 'selected' : '' }}>DP Dibayar</option>
                <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Lunas</option>
            </select>
            <button type="submit" class="px-5 py-2.5 bg-violet-600 text-white rounded-xl text-sm font-semibold hover:bg-violet-500 transition">Filter</button>
        </form>
    </div>

    {{-- Orders Table --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Invoice</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Pelanggan</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Item</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Total</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Bayar</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Waktu</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $order)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-3 font-mono font-semibold text-violet-600">{{ $order->invoice_number }}</td>
                        <td class="px-6 py-3">
                            <p class="font-semibold">{{ $order->customer_name }}</p>
                            <p class="text-xs text-slate-400">{{ $order->customer_phone }}</p>
                        </td>
                        <td class="px-6 py-3 text-xs text-slate-500">{{ $order->items->count() }} item</td>
                        <td class="px-6 py-3 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold
                                {{ $order->payment_status === 'paid' ? 'bg-emerald-50 text-emerald-700' : ($order->payment_status === 'dp_paid' ? 'bg-amber-50 text-amber-700' : 'bg-slate-100 text-slate-600') }}">
                                {{ $order->payment_status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold
                                {{ $order->status === 'completed' ? 'bg-emerald-50 text-emerald-700' : ($order->status === 'cancelled' ? 'bg-red-50 text-red-700' : 'bg-violet-50 text-violet-700') }}">
                                {{ $order->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-xs text-slate-400">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-3">
                            <a href="{{ route('admin.orders.show', $order) }}" class="px-3 py-1.5 bg-violet-50 text-violet-700 rounded-lg text-xs font-semibold hover:bg-violet-100 transition">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12 text-slate-400">Belum ada pesanan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
        <div class="p-4 border-t border-slate-100">{{ $orders->links() }}</div>
        @endif
    </div>
</x-admin-layout>
