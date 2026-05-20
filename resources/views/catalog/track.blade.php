<x-base-layout title="Cek Pesanan - PreOrder">
    <nav class="sticky top-0 z-40 bg-white/80 backdrop-blur-xl border-b border-slate-200/80">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-lg font-black text-white">P</div>
                <span class="font-bold text-xl text-slate-800">PreOrder</span>
            </a>
            <a href="{{ url('/') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-violet-600 transition">← Kembali</a>
        </div>
    </nav>

    <div class="max-w-lg mx-auto px-4 sm:px-6 py-20">
        <div class="text-center mb-8">
            <p class="text-5xl mb-4">📋</p>
            <h1 class="text-3xl font-black text-slate-800 mb-2">Cek Status Pesanan</h1>
            <p class="text-slate-500">Masukkan nomor invoice untuk melihat status pesananmu</p>
        </div>

        <form method="GET" action="" id="trackForm" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-1">Nomor Invoice</label>
                <input type="text" id="invoiceInput" required
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="PO-20260520-0001">
            </div>
            <button type="submit" class="w-full py-3 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg shadow-violet-500/20 hover:shadow-violet-500/40 transition-all hover:-translate-y-0.5">
                Cari Pesanan 🔍
            </button>
        </form>
    </div>

    <script>
    document.getElementById('trackForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const invoice = document.getElementById('invoiceInput').value.trim();
        if (invoice) {
            window.location.href = '/track/' + encodeURIComponent(invoice);
        }
    });
    </script>
</x-base-layout>
