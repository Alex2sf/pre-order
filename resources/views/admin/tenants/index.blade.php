<x-admin-layout title="Daftar UMKM" :header="'🏪 Daftar UMKM'" :subtitle="'Kelola semua tenant bisnis pre-order'">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Nama Bisnis</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Slug</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Owner</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Produk</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Pesanan</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Plan</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($tenants as $tenant)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-3 font-semibold">{{ $tenant->name }}</td>
                        <td class="px-6 py-3 font-mono text-xs text-violet-600">{{ $tenant->slug }}</td>
                        <td class="px-6 py-3">{{ $tenant->users_count }}</td>
                        <td class="px-6 py-3">{{ $tenant->products_count }}</td>
                        <td class="px-6 py-3">{{ $tenant->orders_count }}</td>
                        <td class="px-6 py-3"><span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold bg-violet-50 text-violet-700">{{ ucfirst($tenant->plan) }}</span></td>
                        <td class="px-6 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $tenant->status === 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-600' }}">
                                {{ $tenant->status === 'active' ? '✅ Aktif' : '⏸️ Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <form method="POST" action="{{ route('admin.tenants.toggle', $tenant) }}">
                                @csrf
                                <button class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ $tenant->status === 'active' ? 'bg-red-50 text-red-600 hover:bg-red-100' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                                    {{ $tenant->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-12 text-slate-400">Belum ada UMKM terdaftar</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($tenants->hasPages())
        <div class="p-4 border-t border-slate-100">{{ $tenants->links() }}</div>
        @endif
    </div>
</x-admin-layout>
