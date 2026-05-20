<x-base-layout :title="'Pesanan ' . $order->invoice_number">
    <nav class="sticky top-0 z-40 bg-white/80 backdrop-blur-xl border-b border-slate-200/80">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <a href="{{ route('store', $order->tenant->slug) }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-lg font-black text-white">P</div>
                <span class="font-bold text-xl text-slate-800">{{ $order->tenant->name }}</span>
            </a>
            <a href="{{ route('order.track.form') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-violet-600 transition">← Cek Pesanan Lain</a>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-12">
        @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm mb-6">{{ session('success') }}</div>
        @endif

        {{-- Order Header --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm text-slate-400">Invoice</p>
                    <p class="text-xl font-black font-mono text-violet-600">{{ $order->invoice_number }}</p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-sm font-bold
                        {{ $order->status === 'completed' ? 'bg-emerald-50 text-emerald-700' : ($order->status === 'cancelled' ? 'bg-red-50 text-red-700' : 'bg-violet-50 text-violet-700') }}">
                        {{ $order->status_label }}
                    </span>
                </div>
            </div>

            {{-- Progress Bar --}}
            @php
                $steps = ['pending' => 'Menunggu', 'processing' => 'Diproses', 'ready' => 'Siap', 'completed' => 'Selesai'];
                $currentStep = array_search($order->status, array_keys($steps));
                if ($order->status === 'cancelled') $currentStep = -1;
            @endphp
            @if($order->status !== 'cancelled')
            <div class="flex items-center gap-1 mt-4">
                @foreach($steps as $key => $label)
                @php $stepIndex = array_search($key, array_keys($steps)); @endphp
                <div class="flex-1">
                    <div class="h-2 rounded-full {{ $stepIndex <= $currentStep ? 'bg-gradient-to-r from-violet-500 to-indigo-500' : 'bg-slate-100' }} transition-all"></div>
                    <p class="text-xs mt-1.5 {{ $stepIndex <= $currentStep ? 'text-violet-600 font-semibold' : 'text-slate-400' }}">{{ $label }}</p>
                </div>
                @endforeach
            </div>
            @endif

            <div class="grid grid-cols-2 gap-4 mt-6 text-sm">
                <div><span class="text-slate-400">Nama:</span><p class="font-semibold">{{ $order->customer_name }}</p></div>
                <div><span class="text-slate-400">Telepon:</span><p class="font-semibold">{{ $order->customer_phone }}</p></div>
                <div><span class="text-slate-400">Tanggal:</span><p class="font-semibold">{{ $order->created_at->format('d M Y, H:i') }}</p></div>
                <div>
                    <span class="text-slate-400">Pembayaran:</span>
                    <p class="font-semibold">{{ $order->payment_status_label }}</p>
                </div>
            </div>
        </div>

        {{-- Items --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-6">
            <h3 class="font-bold text-lg mb-4">📦 Item Pesanan</h3>
            @foreach($order->items as $item)
            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 mb-2">
                <div>
                    <p class="font-semibold">{{ $item->product_name }}</p>
                    @if($item->variant_name)
                    <p class="text-xs text-slate-400">Varian: {{ $item->variant_name }}</p>
                    @endif
                </div>
                <div class="text-right">
                    <p class="text-sm text-slate-500">{{ $item->quantity }}x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    <p class="font-bold text-violet-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
            <div class="border-t border-slate-200 mt-4 pt-4">
                <div class="flex justify-between text-lg font-extrabold">
                    <span>Total</span>
                    <span class="text-violet-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm mt-1">
                    <span class="text-slate-400">Sudah Dibayar</span>
                    <span class="text-emerald-600 font-semibold">Rp {{ number_format($order->paid_amount, 0, ',', '.') }}</span>
                </div>
                @if($order->remaining_amount > 0)
                <div class="flex justify-between text-sm mt-1">
                    <span class="text-slate-400">Sisa Tagihan</span>
                    <span class="text-red-500 font-semibold">Rp {{ number_format($order->remaining_amount, 0, ',', '.') }}</span>
                </div>
                @endif
            </div>
        </div>

        {{-- Payment History --}}
        @if($order->payments->count())
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-6">
            <h3 class="font-bold text-lg mb-4">💳 Riwayat Pembayaran</h3>
            @foreach($order->payments as $payment)
            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 mb-2">
                <div>
                    <p class="font-semibold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-400">{{ ucfirst($payment->type) }} • {{ $payment->payment_method }} • {{ $payment->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold
                    {{ $payment->status === 'verified' ? 'bg-emerald-50 text-emerald-700' : ($payment->status === 'rejected' ? 'bg-red-50 text-red-600' : 'bg-amber-50 text-amber-700') }}">
                    {{ $payment->status_label }}
                </span>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Upload Payment --}}
        @if($order->remaining_amount > 0 && $order->status !== 'cancelled')
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h3 class="font-bold text-lg mb-4">📤 Kirim Bukti Pembayaran</h3>
            <form method="POST" action="{{ route('order.payment', $order) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1">Jumlah Transfer *</label>
                        <input type="number" name="amount" required min="1000" value="{{ $order->remaining_amount }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1">Tipe</label>
                        <select name="type" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500">
                            @if($order->paid_amount == 0)
                            <option value="dp">DP (Uang Muka)</option>
                            <option value="full">Bayar Lunas</option>
                            @else
                            <option value="pelunasan">Pelunasan</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Metode Bayar *</label>
                    <input type="text" name="payment_method" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="BCA Transfer / DANA / GoPay">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Bukti Transfer (foto) *</label>
                    <input type="file" name="payment_proof" required accept="image/*"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                </div>
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg shadow-violet-500/20 hover:shadow-violet-500/40 transition-all hover:-translate-y-0.5">
                    Kirim Bukti Pembayaran 📤
                </button>
            </form>
        </div>
        @endif
    </div>

    <footer class="bg-slate-900 text-slate-400 text-sm text-center py-8 mt-12">
        <p>&copy; {{ date('Y') }} PreOrder. Semua hak dilindungi.</p>
    </footer>
</x-base-layout>
