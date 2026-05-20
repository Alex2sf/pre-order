<!DOCTYPE html>
<html lang="id" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WarungGalih Pre-Order</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex">

    <!-- Left Panel: Branding -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-violet-600 via-indigo-700 to-purple-800 relative overflow-hidden">
        <!-- Abstract Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-300 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-indigo-300 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 flex flex-col justify-between p-12 text-white w-full">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center p-2.5 shadow-sm border border-white/20">
                        <svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="text-2xl font-black tracking-tight">WarungGalih<span class="font-light opacity-80">Pre-Order</span></span>
                </div>
            </div>

            <div class="space-y-6">
                <h1 class="text-4xl font-black leading-tight">Kelola pemesanan <br>pre-order Anda <br>dengan mudah.</h1>
                <p class="text-lg text-violet-200 max-w-md leading-relaxed">Sistem manajemen pre-order modern yang dirancang khusus untuk mengelola pesanan, produk, dan pembayaran pelanggan secara otomatis.</p>
                
                <div class="flex items-center gap-6 pt-4">
                    <div class="flex items-center gap-2 text-violet-200">
                        <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center">
                            <i data-lucide="zap" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm font-medium">Super Cepat</span>
                    </div>
                    <div class="flex items-center gap-2 text-violet-200">
                        <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm font-medium">Aman & Terenkripsi</span>
                    </div>
                    <div class="flex items-center gap-2 text-violet-200">
                        <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center">
                            <i data-lucide="search-check" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm font-medium">Lacak Otomatis</span>
                    </div>
                </div>
            </div>

            <div class="text-violet-300 text-sm">
                &copy; {{ date('Y') }} WarungGalih Pre-Order. All rights reserved.
            </div>
        </div>
    </div>

    <!-- Right Panel: Login Form -->
    <div class="flex-1 flex items-center justify-center p-6 sm:p-8 bg-slate-50">
        <div class="w-full max-w-md space-y-8">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-6">
                <div class="flex items-center justify-center gap-2 mb-2">
                    <div class="w-12 h-12 bg-violet-600 rounded-xl flex items-center justify-center p-2.5 shadow-sm text-white">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-slate-800 tracking-tight">WarungGalih<span class="font-light text-violet-600">Pre-Order</span></span>
                </div>
            </div>

            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Selamat datang! 👋</h2>
                <p class="text-slate-500 mt-2">Masuk ke akun Anda untuk mulai mengelola pre-order.</p>
            </div>

            <!-- Session Status / Errors -->
            @if(session('error'))
                <div class="bg-red-50 text-red-600 p-4 rounded-xl flex items-center gap-3 border border-red-100 text-sm font-medium">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('status'))
                <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl flex items-center gap-3 border border-emerald-100 text-sm font-medium">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                               class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-violet-500 focus:ring-2 focus:ring-violet-100 transition-all text-sm shadow-sm" 
                               placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                    <div class="relative" x-data="{ showPass: false }">
                        <i data-lucide="lock" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                        <input id="password" :type="showPass ? 'text' : 'password'" name="password" required autocomplete="current-password"
                               class="w-full pl-10 pr-12 py-3 bg-white border border-slate-200 rounded-xl focus:border-violet-500 focus:ring-2 focus:ring-violet-100 transition-all text-sm shadow-sm" 
                               placeholder="••••••••">
                        <button type="button" @click="showPass = !showPass" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                            <i :data-lucide="showPass ? 'eye-off' : 'eye'" class="w-5 h-5"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="w-4 h-4 text-violet-600 border-slate-300 rounded focus:ring-violet-500 cursor-pointer" name="remember">
                        <span class="ms-2 text-sm text-slate-600 font-medium">Ingat saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-violet-600 hover:text-violet-700 font-semibold" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-violet-600 hover:bg-violet-700 text-white font-bold py-3 px-4 rounded-xl transition-all shadow-lg shadow-violet-200 flex items-center justify-center gap-2 text-sm">
                    <i data-lucide="log-in" class="w-5 h-5"></i>
                    Masuk ke Dashboard
                </button>
            </form>

            <div class="text-center pt-2 space-y-4">
                <p class="text-sm text-slate-500">Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-violet-600 hover:text-violet-700 font-bold">Daftar Gratis</a>
                </p>
                <div class="flex items-center justify-center gap-2">
                    <span class="w-8 h-px bg-slate-200"></span>
                    <span class="text-xs text-slate-400 font-medium">ATAU</span>
                    <span class="w-8 h-px bg-slate-200"></span>
                </div>
                <p class="text-center">
                    <a href="{{ route('order.track.form') }}" class="text-sm text-slate-600 hover:text-violet-600 font-bold flex items-center justify-center gap-1.5">
                        <i data-lucide="search" class="w-4 h-4"></i> Lacak Pesanan Anda
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
