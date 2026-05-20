<!DOCTYPE html>
<html lang="id" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - WarungGalih Pre-Order</title>
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
                <h1 class="text-4xl font-black leading-tight">Mulai perjalanan <br>bisnis pre-order <br>Anda hari ini.</h1>
                <p class="text-lg text-violet-200 max-w-md leading-relaxed">Daftar gratis dan nikmati sistem manajemen pre-order profesional yang akan membantu Anda mengelola pesanan dengan lebih efisien.</p>
                
                <div class="space-y-4 pt-4">
                    <div class="flex items-center gap-3 text-violet-100">
                        <div class="w-6 h-6 bg-emerald-400/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                        </div>
                        <span class="text-sm font-medium">Dashboard penjualan & statistik pesanan</span>
                    </div>
                    <div class="flex items-center gap-3 text-violet-100">
                        <div class="w-6 h-6 bg-emerald-400/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                        </div>
                        <span class="text-sm font-medium">Manajemen katalog produk & varian</span>
                    </div>
                    <div class="flex items-center gap-3 text-violet-100">
                        <div class="w-6 h-6 bg-emerald-400/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                        </div>
                        <span class="text-sm font-medium">Lacak pesanan otomatis oleh pelanggan</span>
                    </div>
                </div>
            </div>

            <div class="text-violet-300 text-sm">
                &copy; {{ date('Y') }} WarungGalih Pre-Order. All rights reserved.
            </div>
        </div>
    </div>

    <!-- Right Panel: Register Form -->
    <div class="flex-1 flex items-center justify-center p-6 sm:p-8 bg-slate-50">
        <div class="w-full max-w-md space-y-6">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-4">
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
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Buat Akun Baru 🚀</h2>
                <p class="text-slate-500 mt-2">Daftarkan usaha Anda dan mulai kelola pre-order.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-xl border border-red-100 text-sm">
                    <ul class="list-disc list-inside font-medium">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Store Name -->
                <div>
                    <label for="store_name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Bisnis / Toko</label>
                    <div class="relative">
                        <i data-lucide="store" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                        <input id="store_name" type="text" name="store_name" value="{{ old('store_name') }}" required 
                               class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-violet-500 focus:ring-2 focus:ring-violet-100 transition-all text-sm shadow-sm" 
                               placeholder="Contoh: Jus Segar Mba Ani">
                    </div>
                </div>

                <!-- Owner Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Pemilik</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                               class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-violet-500 focus:ring-2 focus:ring-violet-100 transition-all text-sm shadow-sm" 
                               placeholder="Nama lengkap Anda">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                        <div class="relative">
                            <i data-lucide="mail" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                                   class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-violet-500 focus:ring-2 focus:ring-violet-100 transition-all text-sm shadow-sm" 
                                   placeholder="nama@email.com">
                        </div>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1.5">No. WhatsApp</label>
                        <div class="relative">
                            <i data-lucide="phone" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required 
                                   class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-violet-500 focus:ring-2 focus:ring-violet-100 transition-all text-sm shadow-sm" 
                                   placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                            <input id="password" type="password" name="password" required 
                                   class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-violet-500 focus:ring-2 focus:ring-violet-100 transition-all text-sm shadow-sm" 
                                   placeholder="Min. 8 karakter">
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Ulangi Password</label>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                            <input id="password_confirmation" type="password" name="password_confirmation" required 
                                   class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-violet-500 focus:ring-2 focus:ring-violet-100 transition-all text-sm shadow-sm" 
                                   placeholder="Ketik ulang password">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-violet-600 hover:bg-violet-700 text-white font-bold py-3 px-4 rounded-xl transition-all shadow-lg shadow-violet-200 flex items-center justify-center gap-2 text-sm mt-2">
                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                    Daftar Sekarang
                </button>
            </form>

            <div class="text-center pt-1">
                <p class="text-sm text-slate-500">Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-violet-600 hover:text-violet-700 font-bold">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
