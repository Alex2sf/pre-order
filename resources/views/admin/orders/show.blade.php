<x-admin-layout title="Detail Pesanan" :header="'📋 ' . $order->invoice_number" :subtitle="'Detail pesanan dari ' . $order->customer_name">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left: Order Details --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Customer Info --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="font-bold text-lg mb-4">👤 Info Pelanggan</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div><span class="text-slate-400">Nama:</span><p class="font-semibold">{{ $order->customer_name }}</p></div>
                    <div><span class="text-slate-400">Telepon:</span><p class="font-semibold">{{ $order->customer_phone }}</p></div>
                    @if($order->customer_address)
                    <div class="col-span-2"><span class="text-slate-400">Alamat:</span><p class="font-semibold">{{ $order->customer_address }}</p></div>
                    @endif
                    @if($order->notes)
                    <div class="col-span-2"><span class="text-slate-400">Catatan:</span><p class="font-semibold">{{ $order->notes }}</p></div>
                    @endif
                </div>
            </div>

            {{-- Items --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="font-bold text-lg mb-4">📦 Item Pesanan</h3>
                <div class="space-y-3">
                    @foreach($order->items as $item)
                    <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50">
                        <div>
                            <p class="font-semibold">{{ $item->product_name }}</p>
                            @if($item->variant_name)
                            <p class="text-xs text-slate-400">Varian: {{ $item->variant_name }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-slate-500">{{ $item->quantity }}x @ Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="font-bold text-violet-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="border-t border-slate-200 mt-4 pt-4 flex justify-between">
                    <span class="font-bold text-lg">Total</span>
                    <span class="font-extrabold text-xl text-violet-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Payments History --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="font-bold text-lg mb-4">💳 Riwayat Pembayaran</h3>
                @forelse($order->payments as $payment)
                <div class="flex items-center justify-between p-4 rounded-xl bg-slate-50 mb-3">
                    <div class="flex items-center gap-4">
                        @if($payment->payment_proof)
                        <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="w-16 h-16 rounded-xl overflow-hidden bg-slate-200 flex-shrink-0">
                            <img src="{{ asset('storage/' . $payment->payment_proof) }}" alt="Bukti" class="w-full h-full object-cover">
                        </a>
                        @endif
                        <div>
                            <p class="font-semibold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                            <p class="text-xs text-slate-400">{{ ucfirst($payment->type) }} • {{ $payment->payment_method ?? '-' }} • {{ $payment->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($payment->status === 'pending')
                        <form method="POST" action="{{ route('admin.payments.verify', $payment) }}">
                            @csrf
                            <button class="px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-lg text-xs font-semibold hover:bg-emerald-100 transition">✅ Verifikasi</button>
                        </form>
                        <form method="POST" action="{{ route('admin.payments.reject', $payment) }}">
                            @csrf
                            <button class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-semibold hover:bg-red-100 transition">❌ Tolak</button>
                        </form>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $payment->status === 'verified' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-600' }}">
                            {{ $payment->status_label }}
                        </span>
                        @endif
                    </div>
                </div>
                @empty
                <p class="text-sm text-slate-400 text-center py-4">Belum ada pembayaran masuk</p>
                @endforelse
            </div>
        </div>

        {{-- Right: Status & Actions --}}
        <div class="space-y-6">
            {{-- Status Summary --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="font-bold text-lg mb-4">📊 Status</h3>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Status Pesanan</span>
                        <span class="font-semibold">{{ $order->status_label }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Pembayaran</span>
                        <span class="font-semibold">{{ $order->payment_status_label }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Total Dibayar</span>
                        <span class="font-bold text-emerald-600">Rp {{ number_format($order->paid_amount, 0, ',', '.') }}</span>
                    </div>
                    @if($order->remaining_amount > 0)
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Sisa Tagihan</span>
                        <span class="font-bold text-red-500">Rp {{ number_format($order->remaining_amount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-400">Tanggal Pesan</span>
                        <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            {{-- Update Status --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="font-bold text-lg mb-4">🔄 Update Status</h3>
                <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="space-y-3">
                    @csrf @method('PATCH')
                    <select name="status" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>⚙️ Diproses</option>
                        <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>📦 Siap Diambil/Kirim</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>✅ Selesai</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>❌ Batalkan</option>
                    </select>
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg shadow-violet-500/20 hover:shadow-violet-500/40 transition-all text-sm">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
