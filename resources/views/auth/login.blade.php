<x-base-layout title="Login">
    <div class="min-h-screen flex items-center justify-center bg-slate-50 p-6">
        <div class="w-full max-w-md bg-white rounded-2xl border border-slate-200 shadow-sm p-8" style="animation: slideInUp 0.5s ease;">
            
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-extrabold text-slate-800 mb-2">Selamat datang</h2>
                <p class="text-slate-400 text-sm">Masuk ke akun Anda untuk mengelola pre-order</p>
            </div>

            @if(session('error'))
            <div class="mb-5 p-4 rounded-xl flex items-start gap-3 text-sm" style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full pl-12 pr-4 py-3.5 rounded-xl border text-sm font-medium outline-none transition-all
                                      bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400
                                      focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10"
                               placeholder="nama@bisnis.com">
                    </div>
                </div>

                <div x-data="{ show: false }">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input :type="show ? 'text' : 'password'" name="password" required
                               class="w-full pl-12 pr-12 py-3.5 rounded-xl border text-sm font-medium outline-none transition-all
                                      bg-slate-50 border-slate-200 text-slate-800 placeholder-slate-400
                                      focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10"
                               placeholder="••••••••">
                        <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-violet-500 focus:ring-violet-500/20 cursor-pointer">
                        <span class="text-sm text-slate-600">Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full py-3.5 rounded-xl text-white text-sm font-bold tracking-wide transition-all duration-300 relative overflow-hidden group"
                        style="background: linear-gradient(135deg, #7c3aed, #6366f1); box-shadow: 0 4px 20px rgba(124,58,237,0.4);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 30px rgba(124,58,237,0.5)'"
                        onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 20px rgba(124,58,237,0.4)'">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Masuk ke Dashboard
                    </span>
                </button>
            </form>

            <div class="my-7 flex items-center gap-4">
                <div class="flex-1 h-px bg-slate-200"></div>
                <span class="text-xs text-slate-400 font-medium">ATAU</span>
                <div class="flex-1 h-px bg-slate-200"></div>
            </div>

            <a href="{{ route('register') }}"
               class="flex items-center justify-center gap-2 w-full py-3.5 rounded-xl text-sm font-bold transition-all duration-300
                      border-2 border-slate-200 text-slate-600
                      hover:border-violet-400 hover:text-violet-600 hover:bg-violet-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Daftar Bisnis Pre-Order — Gratis!
            </a>

            <p class="text-center text-slate-400 text-xs mt-6">
                <a href="{{ route('order.track.form') }}" class="text-violet-500 hover:text-violet-600 font-semibold">🔍 Lacak Pesanan Anda</a>
            </p>
        </div>
    </div>

    <style>
        @keyframes slideInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-base-layout>
