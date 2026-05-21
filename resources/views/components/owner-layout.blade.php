<x-base-layout :title="$title ?? 'Owner Panel'">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gradient-to-b from-slate-900 to-slate-800 text-white flex-shrink-0 hidden lg:flex flex-col">
            <div class="p-6 border-b border-slate-700/50">
                <a href="{{ route('owner.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-lg font-black">P</div>
                    <div>
                        <h1 class="font-bold text-lg leading-tight truncate">{{ Auth::user()->tenant->name ?? 'PreOrder' }}</h1>
                        <p class="text-xs text-slate-400">Owner Panel</p>
                    </div>
                </a>
            </div>
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('owner.dashboard') }}" id="sidebar-dashboard" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('owner.dashboard') ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <span>📊</span> Dashboard
                </a>
                <a href="{{ route('owner.products.index') }}" id="sidebar-produk" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('owner.products.*') ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <span>📦</span> Produk
                </a>
                <a href="{{ route('owner.orders.index') }}" id="sidebar-pesanan" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('owner.orders.*') ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <span>🛒</span> Pesanan
                </a>
                <div class="pt-4 border-t border-slate-700/50 mt-4">
                    <a href="{{ route('store', Auth::user()->tenant->slug ?? '#') }}" target="_blank" id="sidebar-toko" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-white/5 hover:text-white transition">
                        <span>🌐</span> Lihat Toko
                    </a>
                </div>
            </nav>
            <div class="p-4 border-t border-slate-700/50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-red-500/20 hover:text-red-300 transition">
                        <span>🚪</span> Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto">
            <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-xl border-b border-slate-200/80 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">{{ $header ?? 'Dashboard' }}</h2>
                        @isset($subtitle)
                        <p class="text-sm text-slate-500">{{ $subtitle }}</p>
                        @endisset
                    </div>
                    <div class="text-sm text-slate-500">
                        👋 {{ Auth::user()->name }}
                    </div>
                </div>
            </header>

            <div class="px-6 pt-4">
                @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm mb-4">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4">{{ session('error') }}</div>
                @endif
            </div>

            <div class="p-6">
                {{ $slot }}
            </div>
        </main>
    </div>
</x-base-layout>
