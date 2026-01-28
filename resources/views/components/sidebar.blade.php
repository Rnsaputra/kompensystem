<div
    class="md:hidden fixed top-0 left-0 w-full h-16 bg-slate-900 text-white z-50 flex items-center justify-between px-4 shadow-md">

    <div class="flex items-center gap-3">
        <div
            class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg">
            <i class="fas fa-university text-sm"></i>
        </div>
        <div>
            <h1 class="font-bold text-sm tracking-wide">SiKompen</h1>
            <p class="text-[10px] text-slate-400 -mt-0.5">Admin Panel</p>
        </div>
    </div>

    <div class="relative">
        <button onclick="toggleProfileMenu()" class="flex items-center gap-2 focus:outline-none group">
            <div class="text-right mr-1">
                <p class="text-xs font-semibold text-slate-200 group-hover:text-white">
                    {{ auth()->user()->name }}
                </p>
            </div>

            <div
                class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-xs border-2 border-slate-800 transition transform group-active:scale-95 uppercase">
                {{ substr(auth()->user()->name, 0, 2) }}
            </div>

            <i class="fas fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200"
                id="profileChevron"></i>
        </button>

        <div id="mobileProfileMenu"
            class="hidden absolute right-0 top-full mt-3 w-48 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden origin-top-right transition-all duration-200 opacity-0 scale-95 transform">

            <div class="px-4 py-3 border-b border-slate-100 bg-slate-50">
                <p class="text-xs text-slate-500">Login sebagai:</p>
                <p class="text-sm font-bold text-slate-800">
                    {{ ucfirst(auth()->user()->role) }}
                </p>
            </div>

            <a href="{{ route('landing') }}"
                class="block px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition border-b border-slate-50 flex items-center gap-2">
                <i class="fas fa-home w-5 text-center"></i>
                Kembali ke Home
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2 transition">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

<aside id="sidebar"
    class="bg-slate-900 text-white shadow-2xl z-40 
           fixed bottom-0 w-full h-16 flex flex-row justify-around items-center px-2
           md:relative md:h-full md:flex-col md:justify-start md:px-3 md:py-6 md:items-stretch
           md:w-64 sidebar-transition group">

    <div class="hidden md:flex mb-8 w-full justify-center">
        <button id="toggleSidebar"
            class="flex items-center gap-3 w-full p-2 rounded-xl transition-all duration-200 hover:bg-white/5 group">

            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg flex-shrink-0 group-hover:scale-105 transition-transform duration-300 relative">
                <i class="fas fa-university text-lg"></i>
                <div
                    class="hidden minimized-indicator absolute -right-1 -top-1 w-3 h-3 bg-red-500 rounded-full border-2 border-slate-900">
                </div>
            </div>

            <div
                class="sidebar-text flex-1 flex items-center justify-between overflow-hidden whitespace-nowrap transition-opacity duration-300">
                <div class="text-left">
                    <h1 class="font-bold text-base leading-tight">SiKompen</h1>
                    <p class="text-[10px] text-slate-400">{{ ucfirst(auth()->user()->role) }} Panel</p>
                </div>
                <i class="fas fa-chevron-left text-slate-500 group-hover:text-white transition-colors"
                    id="toggleIcon"></i>
            </div>
        </button>
    </div>

    <nav class="flex-1 w-full flex flex-row md:flex-col justify-around md:justify-start md:space-y-2">
        <a href="{{ route('dashboard.index') }}"
            class="nav-item flex flex-col md:flex-row items-center md:gap-3 p-2 md:px-4 md:py-3 rounded-xl text-sm font-medium transition-all duration-200 
            {{ request()->routeIs('dashboard.*') ? 'text-blue-400 md:bg-blue-600 md:text-white md:shadow-lg md:shadow-blue-900/50' : 'text-slate-500 md:text-slate-400 hover:text-slate-200 md:hover:bg-white/10' }}">
            <i class="fas fa-chart-line text-xl md:text-lg mb-1 md:mb-0 w-6 text-center flex-shrink-0"></i>
            <span class="text-[10px] md:text-sm sidebar-text whitespace-nowrap">Dashboard</span>
        </a>

        <a href="{{ route('kompensasi.index') }}"
            class="nav-item flex flex-col md:flex-row items-center md:gap-3 p-2 md:px-4 md:py-3 rounded-xl text-sm font-medium transition-all duration-200 
            {{ request()->routeIs('kompensasi.*') ? 'text-blue-400 md:bg-blue-600 md:text-white md:shadow-lg md:shadow-blue-900/50' : 'text-slate-500 md:text-slate-400 hover:text-slate-200 md:hover:bg-white/10' }}">
            <i class="fas fa-table-list text-xl md:text-lg mb-1 md:mb-0 w-6 text-center flex-shrink-0"></i>
            <span class="text-[10px] md:text-sm sidebar-text whitespace-nowrap">Data Kompen</span>
        </a>

        <a href="{{ route('recap.index') }}"
            class="nav-item flex flex-col md:flex-row items-center md:gap-3 p-2 md:px-4 md:py-3 rounded-xl text-sm font-medium transition-all duration-200 
            {{ request()->routeIs('recap.index') ? 'text-blue-400 md:bg-blue-600 md:text-white md:shadow-lg md:shadow-blue-900/50' : 'text-slate-500 md:text-slate-400 hover:text-slate-200 md:hover:bg-white/10' }}">
            <i class="fas fa-chart-bar text-xl md:text-lg mb-1 md:mb-0 w-6 text-center flex-shrink-0"></i>
            <span class="text-[10px] md:text-sm sidebar-text whitespace-nowrap">Recap Data</span>
        </a>
    </nav>

    <div class="hidden md:flex flex-col space-y-2 mt-auto pt-4 border-t border-slate-800">

        <a href="{{ route('landing') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-400 hover:bg-white/5 hover:text-white transition-all whitespace-nowrap overflow-hidden">
            <i class="fas fa-home text-lg w-6 text-center flex-shrink-0"></i>
            <span class="sidebar-text">Kembali ke Home</span>
        </a>

        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all text-left whitespace-nowrap overflow-hidden">
                <i class="fas fa-sign-out-alt text-lg w-6 text-center flex-shrink-0"></i>
                <span class="sidebar-text">Logout</span>
            </button>
        </form>

        <div
            class="flex items-center gap-3 px-4 py-3 mt-2 bg-slate-800/50 rounded-xl border border-slate-700/50 sidebar-text-container whitespace-nowrap overflow-hidden">
            <div
                class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-xs flex-shrink-0 uppercase">
                {{ substr(auth()->user()->name, 0, 2) }}
            </div>

            <div class="sidebar-text">
                <p class="text-xs font-bold text-white truncate w-32">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-[10px] text-slate-400 truncate">
                    {{ ucfirst(auth()->user()->role) }}
                </p>
            </div>
        </div>
        <div class="text-center pt-2 sidebar-text">
            <p class="text-slate-500 text-[10px]">
                &copy; {{ date('Y') }} Rnsaputra.
            </p>
        </div>
    </div>
</aside>
<div
    class="md:hidden fixed bottom-16 left-0 w-full bg-slate-900/90 backdrop-blur-sm border-t border-slate-800 py-2 z-30">
    <div class="text-center">
        <p class="text-slate-500 text-[10px]">
            &copy; {{ date('Y') }} Rnsaputra.
        </p>
    </div>
</div>
<script>
    // --- Logic Dropdown Profile Mobile ---
    function toggleProfileMenu() {
        const menu = document.getElementById('mobileProfileMenu');
        const chevron = document.getElementById('profileChevron');

        if (menu.classList.contains('hidden')) {
            // Buka
            menu.classList.remove('hidden');
            setTimeout(() => {
                menu.classList.remove('opacity-0', 'scale-95');
                menu.classList.add('opacity-100', 'scale-100');
                chevron.classList.add('rotate-180');
            }, 10);
        } else {
            // Tutup
            menu.classList.remove('opacity-100', 'scale-100');
            menu.classList.add('opacity-0', 'scale-95');
            chevron.classList.remove('rotate-180');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 200);
        }
    }

    // Tutup dropdown jika klik di luar
    document.addEventListener('click', (e) => {
        const menu = document.getElementById('mobileProfileMenu');
        const trigger = e.target.closest('button');
        if (!trigger && !menu.contains(e.target) && !menu.classList.contains('hidden')) {
            toggleProfileMenu();
        }
    });

    // --- Logic Sidebar Desktop (Minimize) ---
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const toggleIcon = document.getElementById('toggleIcon');
        // Ambil semua elemen text yang perlu di-hide saat minimize
        const texts = document.querySelectorAll('.sidebar-text');

        // Cek LocalStorage
        const isMinimized = localStorage.getItem('sidebarMinimized') === 'true';
        if (isMinimized && window.innerWidth >= 768) {
            applyMinimize(true);
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                const isCurrentlyMinimized = sidebar.classList.contains('md:w-20');
                applyMinimize(!isCurrentlyMinimized);
            });
        }

        function applyMinimize(minimize) {
            if (minimize) {
                // Mode Kecil
                sidebar.classList.remove('md:w-64');
                sidebar.classList.add('md:w-20');

                // Sembunyikan Text
                texts.forEach(el => el.classList.add('hidden'));

                // Putar Icon Toggle
                if (toggleIcon) toggleIcon.classList.add('rotate-180');

                // Simpan State
                localStorage.setItem('sidebarMinimized', 'true');
            } else {
                // Mode Besar
                sidebar.classList.remove('md:w-20');
                sidebar.classList.add('md:w-64');

                // Tampilkan Text
                texts.forEach(el => el.classList.remove('hidden'));

                if (toggleIcon) toggleIcon.classList.remove('rotate-180');

                localStorage.setItem('sidebarMinimized', 'false');
            }
        }
    });
</script>
