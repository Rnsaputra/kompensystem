<x-layout title="Dashboard">
    <div class="space-y-6 animate-fade-in pb-20">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-2">
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-slate-800">Overview</h2>
                <p class="text-sm text-slate-500">Ringkasan statistik kompensasi</p>
            </div>
            <div class="text-xs font-semibold text-slate-400 bg-slate-100 px-3 py-1 rounded-full w-fit">
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">

            <div
                class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div
                    class="absolute right-0 top-0 p-3 opacity-10 text-blue-600 group-hover:scale-110 transition transform">
                    <i class="fas fa-users text-6xl"></i>
                </div>
                <div>
                    <p class="text-slate-500 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-1">Mahasiswa
                    </p>
                    <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $total_mhs }}</h3>
                </div>
            </div>

            <div
                class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div
                    class="absolute right-0 top-0 p-3 opacity-10 text-amber-600 group-hover:scale-110 transition transform">
                    <i class="fas fa-clock text-6xl"></i>
                </div>
                <div>
                    <p class="text-slate-500 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-1">Total Jam
                    </p>
                    <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $total_jam }}</h3>
                </div>
            </div>

            <div
                class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div
                    class="absolute right-0 top-0 p-3 opacity-10 text-emerald-600 group-hover:scale-110 transition transform">
                    <i class="fas fa-check-circle text-6xl"></i>
                </div>
                <div>
                    <p class="text-slate-500 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-1">Lunas</p>
                    <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $mhs_selesai }}</h3>
                </div>
            </div>

            <div
                class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div
                    class="absolute right-0 top-0 p-3 opacity-10 text-red-600 group-hover:scale-110 transition transform">
                    <i class="fas fa-exclamation-circle text-6xl"></i>
                </div>
                <div>
                    <p class="text-slate-500 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-1">Belum</p>
                    <h3 class="text-2xl md:text-3xl font-bold text-slate-800">{{ $mhs_aktif }}</h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-slate-800 text-lg">Input Terbaru</h3>
                    <a href="{{ route('kompensasi.index') }}"
                        class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg hover:bg-blue-100 transition">Lihat
                        Semua</a>
                </div>

                <div class="space-y-3">
                    @forelse($recents as $item)
                        <div
                            class="flex justify-between items-center p-3 bg-slate-50 rounded-xl hover:bg-slate-100 transition group">
                            <div class="flex items-center gap-3 min-w-0 flex-1">
                                <div
                                    class="flex-shrink-0 w-8 h-8 rounded-full {{ $item->status == 'Lunas' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }} flex items-center justify-center text-xs">
                                    <i
                                        class="fas {{ $item->status == 'Lunas' ? 'fa-check' : 'fa-hourglass-half' }}"></i>
                                </div>

                                <div class="min-w-0">
                                    <p class="font-bold text-slate-700 text-sm truncate pr-2">
                                        {{ $item->mahasiswa->nama }}</p>
                                    <p class="text-[10px] md:text-xs text-slate-500 truncate">
                                        {{ $item->mahasiswa->kelas }} • {{ $item->mahasiswa->nim }}</p>
                                </div>
                            </div>

                            <div class="text-right flex-shrink-0">
                                <span
                                    class="block text-sm font-bold {{ $item->status == 'Lunas' ? 'text-emerald-600' : 'text-slate-700' }}">
                                    {{ $item->total_kompensasi }} Jam
                                </span>
                                <span
                                    class="text-[10px] uppercase font-bold tracking-wide {{ $item->status == 'Lunas' ? 'text-emerald-500' : 'text-amber-500' }}">
                                    {{ $item->status == 'Belum Lunas' ? 'Belum' : 'Lunas' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 text-slate-400">
                            <i class="fas fa-folder-open text-4xl mb-3 opacity-30"></i>
                            <p class="text-sm">Belum ada data masuk.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 md:p-8 text-white flex flex-col justify-center items-center text-center shadow-lg shadow-blue-500/30 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                    <i class="fas fa-rocket text-[150px] absolute -left-10 -bottom-10"></i>
                </div>

                <div class="relative z-10">
                    <div
                        class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                        <i class="fas fa-rocket text-3xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-2">Sistem Ready!</h3>
                    <p class="text-sm md:text-base opacity-90 max-w-xs mx-auto mb-6 leading-relaxed">
                        Kelola data kompensasi mahasiswa dengan mudah, cepat, dan transparan.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        <a href="{{ route('recap.index') }}"
                            class="w-full sm:w-auto px-6 py-3 bg-white text-blue-600 rounded-xl font-bold hover:bg-blue-50 transition shadow-lg text-sm">
                            <i class="fas fa-chart-bar mr-2"></i> Buka Recap
                        </a>
                        <a href="{{ route('kompensasi.index') }}"
                            class="w-full sm:w-auto px-6 py-3 bg-blue-800/50 text-white border border-white/20 rounded-xl font-bold hover:bg-blue-800 transition text-sm">
                            <i class="fas fa-list mr-2"></i> Input Data
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
