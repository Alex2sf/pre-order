<x-base-layout title="Daftar">
    <div class="min-h-screen flex items-center justify-center bg-slate-50 p-6">
        <div class="w-full max-w-xl bg-white rounded-2xl border border-slate-200 shadow-sm p-8" style="animation: slideInUp 0.5s ease;">
            
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-extrabold text-slate-800 mb-2">Daftar Bisnis</h2>
                <p class="text-slate-400 text-sm">Buat akun dan langsung mulai terima pre-order</p>
            </div>

            @if(session('error'))
            <div class="mb-5 p-4 rounded-xl flex items-start gap-3 text-sm" style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-5 p-4 rounded-xl text-sm" style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Store Name --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Bisnis / Toko</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <input type="text" name="store_name" value="{{ old('store_name') }}" required
                               class="w-full pl-12 pr-4 py-3.5 rounded-xl border text-sm font-medium outline-none transition-all
                                      bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400
                                      focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10"
                               placeholder="Contoh: Jus Segar Mba Ani">
                    </div>
                </div>

                {{-- Owner Name --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Pemilik</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full pl-12 pr-4 py-3.5 rounded-xl border text-sm font-medium outline-none transition-all
                                      bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400
                                      focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10"
                               placeholder="Nama lengkap Anda">
                    </div>
                </div>

                {{-- Email & Phone --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full pl-12 pr-4 py-3.5 rounded-xl border text-sm font-medium outline-none transition-all
                                          bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400
                                          focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10"
                                   placeholder="email@contoh.com">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">No. WhatsApp</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="w-full pl-12 pr-4 py-3.5 rounded-xl border text-sm font-medium outline-none transition-all
                                          bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400
                                          focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10"
                                   placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                </div>

                {{-- Passwords --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input type="password" name="password" required
                                   class="w-full pl-12 pr-4 py-3.5 rounded-xl border text-sm font-medium outline-none transition-all
                                          bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400
                                          focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10"
                                   placeholder="Min. 8 karakter">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <input type="password" name="password_confirmation" required
                                   class="w-full pl-12 pr-4 py-3.5 rounded-xl border text-sm font-medium outline-none transition-all
                                          bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400
                                          focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10"
                                   placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                <button type="submit"
                        class="w-full py-3.5 rounded-xl text-white text-sm font-bold tracking-wide transition-all duration-300 relative overflow-hidden group"
                        style="background: linear-gradient(135deg, #7c3aed, #6366f1); box-shadow: 0 4px 20px rgba(124,58,237,0.4);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 30px rgba(124,58,237,0.5)'"
                        onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 20px rgba(124,58,237,0.4)'">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Daftar Sekarang — Gratis!
                    </span>
                </button>
            </form>

            <div class="my-7 flex items-center gap-4">
                <div class="flex-1 h-px bg-slate-200"></div>
                <span class="text-xs text-slate-400 font-medium">ATAU</span>
                <div class="flex-1 h-px bg-slate-200"></div>
            </div>

            <a href="{{ route('login') }}"
               class="flex items-center justify-center gap-2 w-full py-3.5 rounded-xl text-sm font-bold transition-all duration-300
                      border-2 border-slate-200 text-slate-600
                      hover:border-violet-400 hover:text-violet-600 hover:bg-violet-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Sudah punya akun? Masuk
            </a>
        </div>
    </div>

    <style>
        @keyframes slideInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-base-layout>
