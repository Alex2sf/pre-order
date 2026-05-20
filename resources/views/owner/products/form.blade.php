<x-owner-layout title="{{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}" :header="isset($product) ? '✏️ Edit Produk' : '➕ Tambah Produk'" :subtitle="isset($product) ? 'Perbarui detail produk' : 'Tambahkan produk pre-order baru'">
    <div class="max-w-3xl">
        <form method="POST" action="{{ isset($product) ? route('owner.products.update', $product) : route('owner.products.store') }}" 
              x-data="{ isPreorder: {{ isset($product) ? ($product->is_preorder ? 'true' : 'false') : 'true' }} }"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @isset($product) @method('PUT') @endisset

            {{-- Basic Info --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-4">
                <h3 class="font-bold text-lg">📋 Info Produk</h3>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Nama Produk *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="Misal: Jus Mangga, Gelang Custom">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="Deskripsi produk...">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Harga Dasar (Rp) *</label>
                    <input type="number" name="base_price" value="{{ old('base_price', $product->base_price ?? '') }}" required min="0"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="15000">
                    @error('base_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Gambar Produk</label>
                    @if(isset($product) && $product->image_path)
                        <div class="mb-3 flex items-center gap-3 p-3 bg-slate-50 border border-slate-100 rounded-xl">
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="Preview" class="w-16 h-16 object-cover rounded-lg border">
                            <span class="text-xs text-slate-400">Gambar saat ini</span>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-violet-50 file:text-violet-600 hover:file:bg-violet-100 cursor-pointer">
                    <p class="text-xs text-slate-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Maks 2MB.</p>
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- PO Configuration --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-4">
                <h3 class="font-bold text-lg">⚙️ Konfigurasi PO</h3>
                <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="hidden" name="is_preorder" value="0">
                        <input type="checkbox" name="is_preorder" value="1" x-model="isPreorder"
                               class="w-5 h-5 rounded border-slate-300 text-violet-600 focus:ring-violet-500">
                        <div>
                            <p class="font-semibold text-sm">Mode Pre-Order (ada batas waktu)</p>
                            <p class="text-xs text-slate-400">Jika tidak dicentang, produk ini selalu bisa dipesan (Always Open)</p>
                        </div>
                    </label>
                </div>

                <div x-show="isPreorder" x-cloak class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1">Buka PO</label>
                        <input type="datetime-local" name="po_start_date" value="{{ old('po_start_date', isset($product) && $product->po_start_date ? $product->po_start_date->format('Y-m-d\TH:i') : '') }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1">Tutup PO</label>
                        <input type="datetime-local" name="po_end_date" value="{{ old('po_end_date', isset($product) && $product->po_end_date ? $product->po_end_date->format('Y-m-d\TH:i') : '') }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1">Kuota (opsional)</label>
                        <input type="number" name="quota" value="{{ old('quota', $product->quota ?? '') }}" min="1"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="Kosongkan = unlimited">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1">Min DP (%)</label>
                        <input type="number" name="min_dp_percent" value="{{ old('min_dp_percent', $product->min_dp_percent ?? 100) }}" required min="1" max="100"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="100">
                        <p class="text-xs text-slate-400 mt-1">100 = Wajib Lunas</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1">Estimasi Pengiriman (hari)</label>
                        <input type="number" name="estimated_delivery_days" value="{{ old('estimated_delivery_days', $product->estimated_delivery_days ?? '') }}" min="1"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition" placeholder="7">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg shadow-violet-500/20 hover:shadow-violet-500/40 transition-all hover:-translate-y-0.5">
                    {{ isset($product) ? 'Simpan Perubahan' : 'Tambah Produk' }}
                </button>
                <a href="{{ route('owner.products.index') }}" class="px-6 py-3 bg-slate-100 text-slate-600 font-semibold rounded-xl hover:bg-slate-200 transition">Batal</a>
            </div>
        </form>

        {{-- Variants Section (only on edit) --}}
        @isset($product)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mt-6">
            <h3 class="font-bold text-lg mb-4">🏷️ Varian Produk</h3>
            <p class="text-sm text-slate-400 mb-4">Misal: Ukuran M (+0), Ukuran L (+5000), Rasa Mangga (+0), Custom Nama (+10000)</p>

            {{-- Add Variant Form --}}
            <form method="POST" action="{{ route('owner.products.variants.store', $product) }}" class="flex flex-wrap items-end gap-3 mb-4 p-4 rounded-xl bg-slate-50">
                @csrf
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-xs font-semibold text-slate-500 mb-1">Nama Varian</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500" placeholder="Rasa Mangga">
                </div>
                <div class="w-40">
                    <label class="block text-xs font-semibold text-slate-500 mb-1">Selisih Harga</label>
                    <input type="number" name="price_adjustment" value="0" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500" placeholder="0">
                </div>
                <div class="w-32">
                    <label class="block text-xs font-semibold text-slate-500 mb-1">Kuota</label>
                    <input type="number" name="quota" min="1" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-violet-500" placeholder="Optional">
                </div>
                <button type="submit" class="px-4 py-2 bg-violet-600 text-white rounded-lg text-sm font-semibold hover:bg-violet-500 transition">+ Tambah</button>
            </form>

            {{-- Existing Variants --}}
            @if($product->variants->count())
            <div class="space-y-2">
                @foreach($product->variants as $variant)
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50">
                    <div>
                        <span class="font-semibold">{{ $variant->name }}</span>
                        <span class="text-sm text-slate-400 ml-2">
                            {{ $variant->price_adjustment >= 0 ? '+' : '' }}Rp {{ number_format($variant->price_adjustment, 0, ',', '.') }}
                            → Total: Rp {{ number_format($variant->final_price, 0, ',', '.') }}
                        </span>
                    </div>
                    <form method="POST" action="{{ route('owner.variants.destroy', $variant) }}" onsubmit="return confirm('Hapus varian ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:text-red-700 text-sm font-semibold transition">🗑️ Hapus</button>
                    </form>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-sm text-slate-400 text-center py-4">Belum ada varian. Tambahkan di atas.</p>
            @endif
        </div>
        @endisset
    </div>
</x-owner-layout>
