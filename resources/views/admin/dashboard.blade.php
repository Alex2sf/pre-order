<x-admin-layout title="Dashboard Admin" :header="'📊 Dashboard Super Admin'" :subtitle="'Monitoring semua UMKM Pre-Order'">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total UMKM</p>
            <p class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalTenants }}</p>
            <p class="text-xs text-slate-400 mt-1">{{ $activeTenants }} aktif</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total Owner</p>
            <p class="text-3xl font-extrabold text-violet-600 mt-1">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total Produk</p>
            <p class="text-3xl font-extrabold text-indigo-600 mt-1">{{ $totalProducts }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total Pesanan</p>
            <p class="text-3xl font-extrabold text-emerald-600 mt-1">{{ $totalOrders }}</p>
            <p class="text-xs text-slate-400 mt-1">Revenue: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Tenants List --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-lg">🏪 UMKM Terdaftar</h3>
            <a href="{{ route('admin.tenants.index') }}" class="text-sm text-violet-600 font-medium hover:text-violet-500 transition">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Nama Bisnis</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Owner</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Produk</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Pesanan</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Bergabung</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentTenants as $tenant)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-3 font-semibold">{{ $tenant->name }}</td>
                        <td class="px-6 py-3 text-slate-500">{{ $tenant->users_count }} user</td>
                        <td class="px-6 py-3">{{ $tenant->products_count }} produk</td>
                        <td class="px-6 py-3">{{ $tenant->orders_count }} pesanan</td>
                        <td class="px-6 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $tenant->status === 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-600' }}">
                                {{ $tenant->status === 'active' ? '✅ Aktif' : '⏸️ Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-xs text-slate-400">{{ $tenant->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-12 text-slate-400">Belum ada UMKM terdaftar</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
