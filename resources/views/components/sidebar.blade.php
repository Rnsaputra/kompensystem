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
                <p class="text-xs font-semibold text-slate-200 group-hover:text-white">Admin</p>
            </div>
            <div
                class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-xs border-2 border-slate-800 transition transform group-active:scale-95">
                AD
            </div>
            <i class="fas fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200"
                id="profileChevron"></i>
        </button>

        <div id="mobileProfileMenu"
            class="hidden absolute right-0 top-full mt-3 w-48 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden origin-top-right transition-all duration-200 opacity-0 scale-95 transform">

            <div class="px-4 py-3 border-b border-slate-100 bg-slate-50">
                <p class="text-xs text-slate-500">Login sebagai:</p>
                <p class="text-sm font-bold text-slate-800">Administrator</p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2 transition">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

<aside id="sidebar"
    class="bg-slate-900 text-white shadow-2xl z-40 
           fixed bottom-0 w-full h-16 flex flex-row justify-around items-center px-2
           md:relative md:h-full md:flex-col md:justify-start md:px-0 md:items-stretch
           md:w-64 sidebar-transition group">

    <div
        class="hidden md:flex p-6 border-b border-slate-800 items-center justify-between whitespace-nowrap overflow-hidden">
        <div class="flex items-center gap-3 transition-all duration-300">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg flex-shrink-0">
                <i class="fas fa-university text-lg"></i>
            </div>
            <div class="sidebar-text transition-opacity duration-300 opacity-100">
                <h1 class="font-bold text-base">SiKompen</h1>
                <p class="text-xs text-slate-400">Panel Admin</p>
            </div>
        </div>
        <button id="toggleSidebar" class="text-slate-400 hover:text-white transition-colors">
            <i class="fas fa-chevron-left transition-transform duration-300" id="toggleIcon"></i>
        </button>
    </div>

    <nav class="flex-1 w-full md:p-4 flex flex-row md:flex-col justify-around md:justify-start md:space-y-2">

        <a href="{{ route('dashboard.index') }}"
            class="nav-item flex flex-col md:flex-row items-center md:gap-3 p-1 md:px-4 md:py-3 rounded-xl text-sm font-medium transition-all duration-200 
           {{ request()->routeIs('dashboard.*') ? 'text-blue-400 md:bg-blue-600 md:text-white' : 'text-slate-500 md:text-slate-400 hover:text-slate-200 md:hover:bg-white/10' }}">
            <i class="fas fa-chart-line text-lg md:text-base mb-1 md:mb-0"></i>
            <span class="text-[10px] md:text-sm sidebar-text">Dashboard</span>
        </a>

        <a href="{{ route('kompensasi.index') }}"
            class="nav-item flex flex-col md:flex-row items-center md:gap-3 p-1 md:px-4 md:py-3 rounded-xl text-sm font-medium transition-all duration-200 
           {{ request()->routeIs('kompensasi.*') ? 'text-blue-400 md:bg-blue-600 md:text-white' : 'text-slate-500 md:text-slate-400 hover:text-slate-200 md:hover:bg-white/10' }}">
            <i class="fas fa-table-list text-lg md:text-base mb-1 md:mb-0"></i>
            <span class="text-[10px] md:text-sm sidebar-text">Data Kompen</span>
        </a>

        <form action="{{ route('logout') }}" method="POST" class="w-full md:mt-auto hidden md:flex">
            @csrf
            <button type="submit"
                class="w-full nav-item flex flex-col md:flex-row items-center md:gap-3 p-1 md:px-4 md:py-3 rounded-xl text-sm font-medium transition-all duration-200 text-red-400 hover:text-red-300 hover:bg-red-500/10">
                <i class="fas fa-sign-out-alt text-lg md:text-base mb-1 md:mb-0"></i>
                <span class="text-[10px] md:text-sm sidebar-text">Logout</span>
            </button>
        </form>

    </nav>

    <div class="hidden md:flex p-4 border-t border-slate-800 whitespace-nowrap overflow-hidden">
        <div class="flex items-center gap-3 px-3 py-2 bg-slate-800/50 rounded-xl border border-slate-700/50 w-full">
            <div
                class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                AD
            </div>
            <div class="sidebar-text transition-opacity duration-300 opacity-100">
                <p class="text-sm font-medium text-slate-200">Admin</p>
                <p class="text-[10px] text-slate-500">Super User</p>
            </div>
        </div>
    </div>
</aside>

<script>
    // --- Logic Dropdown Profile Mobile ---
    function toggleProfileMenu() {
        const menu = document.getElementById('mobileProfileMenu');
        const chevron = document.getElementById('profileChevron');

        if (menu.classList.contains('hidden')) {
            // Buka Menu
            menu.classList.remove('hidden');
            // Delay sedikit untuk animasi
            setTimeout(() => {
                menu.classList.remove('opacity-0', 'scale-95');
                menu.classList.add('opacity-100', 'scale-100');
                chevron.classList.add('rotate-180');
            }, 10);
        } else {
            // Tutup Menu
            menu.classList.remove('opacity-100', 'scale-100');
            menu.classList.add('opacity-0', 'scale-95');
            chevron.classList.remove('rotate-180');

            setTimeout(() => {
                menu.classList.add('hidden');
            }, 200);
        }
    }

    // Tutup dropdown jika klik di luar area
    document.addEventListener('click', (e) => {
        const menu = document.getElementById('mobileProfileMenu');
        const trigger = e.target.closest('button');

        // Jika yang diklik bukan tombol trigger dan bukan menu itu sendiri
        if (!trigger && !menu.contains(e.target) && !menu.classList.contains('hidden')) {
            toggleProfileMenu(); // Tutup
        }
    });


    // --- Logic Sidebar Desktop (Minimize) ---
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const toggleIcon = document.getElementById('toggleIcon');
        const texts = document.querySelectorAll('.sidebar-text');

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
                sidebar.classList.remove('md:w-64');
                sidebar.classList.add('md:w-20');
                texts.forEach(el => el.classList.add('hidden'));
                if (toggleIcon) toggleIcon.classList.add('rotate-180');
                localStorage.setItem('sidebarMinimized', 'true');
            } else {
                sidebar.classList.remove('md:w-20');
                sidebar.classList.add('md:w-64');
                texts.forEach(el => el.classList.remove('hidden'));
                if (toggleIcon) toggleIcon.classList.remove('rotate-180');
                localStorage.setItem('sidebarMinimized', 'false');
            }
        }
    });
</script>
