<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Kompensasi</title>

    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <style>
        body {
            font-family: 'poppins', sans-serif;
        }

        .pattern-diagonal-lines {
            background-image: repeating-linear-gradient(45deg, transparent, transparent 5px, rgba(255, 255, 255, 0.05) 5px, rgba(255, 255, 255, 0.05) 10px);
        }
    </style>
</head>

<body class="antialiased flex flex-col min-h-screen relative text-slate-800"
    style="background-image: url('{{ asset('img/background.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed; background-repeat: no-repeat;">

    <div class="absolute inset-0 bg-slate-50/90 z-0"></div>

    <div class="relative z-10 flex flex-col min-h-screen">

        <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white shadow-md">
                            <i class="fas fa-university text-sm"></i>
                        </div>
                        <span class="font-bold text-lg tracking-tight text-slate-800">SiKompen</span>
                    </div>
                    <div>
                        <a href="{{ route('dashboard.index') }}"
                            class="group relative inline-flex items-center gap-2 px-6 py-2.5 bg-slate-900 text-white rounded-full text-sm font-medium hover:bg-slate-800 transition-all hover:shadow-lg hover:-translate-y-0.5">
                            <span>Dashboard Admin</span>
                            <i class="fas fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1">

            <div class="pt-32 pb-10 px-4 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-4 tracking-tight">
                    Cek Status <span class="text-indigo-600">Kompensasi</span>
                </h1>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Rekapan data ketidakhadiran dan kewajiban kompensasi mahasiswa secara real-time dan transparan.
                </p>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div
                        class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden hover:shadow-md transition">
                        <div class="absolute right-0 top-0 p-4 opacity-5 text-indigo-600"><i
                                class="fas fa-calculator text-6xl"></i></div>
                        <h3 class="font-bold text-slate-800 mb-3 flex items-center gap-2"><i
                                class="fas fa-file-invoice text-indigo-500"></i> Rumus Perhitungan</h3>
                        <div class="bg-slate-50 rounded-lg p-3 text-center border border-slate-100">
                            <div class="flex items-center justify-center gap-2 text-sm text-slate-700 font-mono">
                                <span class="font-bold">Alpha</span> <i
                                    class="fas fa-times text-[10px] text-slate-400"></i>
                                <span class="font-bold text-indigo-600">{{ $pengali }} (Pengali)</span>
                                <i class="fas fa-equals text-[10px] text-slate-400"></i> <span class="font-bold">Total
                                    Jam</span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-400 mt-3 leading-relaxed">Setiap 1 jam ketidakhadiran dikalikan
                            faktor pengali ({{ $pengali }}x).</p>
                    </div>
                    <div
                        class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden hover:shadow-md transition">
                        <div class="absolute right-0 top-0 p-4 opacity-5 text-emerald-600"><i
                                class="fas fa-th text-6xl"></i></div>
                        <h3 class="font-bold text-slate-800 mb-3 flex items-center gap-2"><i
                                class="fas fa-cube text-emerald-500"></i> Sistem Blok (D)</h3>
                        <div class="bg-slate-50 rounded-lg p-3 text-center border border-slate-100">
                            <div class="flex items-center justify-center gap-2 text-sm text-slate-700 font-mono">
                                <span class="font-bold">1 Kotak (D)</span> <i
                                    class="fas fa-equals text-[10px] text-slate-400"></i>
                                <span class="font-bold text-emerald-600">8 Jam Kerja</span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-400 mt-3 leading-relaxed">Kolom D1, D2 merepresentasikan 1 hari
                            kerja (8 jam).</p>
                    </div>
                    <div
                        class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden hover:shadow-md transition">
                        <div class="absolute right-0 top-0 p-4 opacity-5 text-amber-600"><i
                                class="fas fa-clipboard-check text-6xl"></i></div>
                        <h3 class="font-bold text-slate-800 mb-3 flex items-center gap-2"><i
                                class="fas fa-info-circle text-amber-500"></i> Ketentuan</h3>
                        <ul class="text-xs text-slate-500 space-y-2">
                            <li class="flex items-start gap-2"><i
                                    class="fas fa-check-circle text-emerald-500 mt-0.5"></i> <span>Status <b>LUNAS</b>
                                    jika seluruh kotak putih tercentang.</span></li>
                            <li class="flex items-start gap-2"><i class="fas fa-square text-slate-800 mt-0.5"></i>
                                <span>Kotak <b>Hitam</b> berarti area bebas tanggungan.</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-100 overflow-hidden">

                    <div
                        class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-slate-50/50">
                        <div class="flex flex-col md:flex-row md:items-center gap-4 w-full md:w-auto">
                            <div>
                                <h3 class="font-bold text-slate-800 text-lg">Rekapitulasi Mahasiswa</h3>
                                <p class="text-sm text-slate-500">Real-time Data</p>
                            </div>

                            <form action="{{ route('landing') }}" method="GET" class="md:ml-4">
                                <div class="relative group w-full md:w-48">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-sort text-slate-400 text-xs"></i>
                                    </div>
                                    <select name="sort" onchange="this.form.submit()"
                                        class="pl-8 pr-4 py-2 w-full bg-white border border-slate-200 text-slate-700 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer shadow-sm hover:border-blue-400 transition appearance-none">
                                        <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>
                                            Urutkan: Nama</option>
                                        <option value="kelas" {{ request('sort') == 'kelas' ? 'selected' : '' }}>
                                            Urutkan: Kelas</option>
                                        <option value="jam_tinggi"
                                            {{ request('sort') == 'jam_tinggi' ? 'selected' : '' }}>Jam: Tertinggi
                                        </option>
                                        <option value="jam_rendah"
                                            {{ request('sort') == 'jam_rendah' ? 'selected' : '' }}>Jam: Terendah
                                        </option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="flex flex-wrap gap-4 text-xs font-medium text-slate-600">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-4 h-4 border border-slate-200 bg-white flex items-center justify-center rounded">
                                    <i class="fas fa-check text-emerald-500 text-[10px]"></i></div><span>Selesai</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 border border-slate-200 bg-white rounded"></div><span>Belum</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 bg-slate-900 rounded"></div><span>Bebas</span>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse whitespace-nowrap">
                            <thead>
                                <tr
                                    class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                                    <th
                                        class="p-4 text-left sticky left-0 bg-slate-50 z-10 border-r min-w-[200px] shadow-sm">
                                        <div class="flex items-center gap-2">
                                            Mahasiswa
                                            @if (request('sort') == 'kelas')
                                                <span
                                                    class="text-[10px] bg-blue-100 text-blue-600 px-1.5 py-0.5 rounded normal-case">Sorted
                                                    by Kelas</span>
                                            @endif
                                        </div>
                                    </th>

                                    <th class="p-4 text-center min-w-[80px]">
                                        <div class="flex items-center justify-center gap-1">
                                            Total Jam
                                            @if (request('sort') == 'jam_tinggi')
                                                <i class="fas fa-caret-down text-blue-600"></i>
                                            @elseif(request('sort') == 'jam_rendah')
                                                <i class="fas fa-caret-up text-blue-600"></i>
                                            @endif
                                        </div>
                                    </th>

                                    <th class="p-4 text-center min-w-[100px]">Status</th>

                                    @for ($i = 1; $i <= $jumlah_kolom; $i++)
                                        <th class="p-2 text-center min-w-[50px] border-l border-slate-100 text-[10px]">
                                            D{{ $i }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse($data as $item)
                                    @php $kotak_aktif = ceil($item->total_kompensasi / 8); @endphp
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td
                                            class="p-4 sticky left-0 bg-white z-10 border-r border-slate-100 shadow-sm">
                                            <div class="font-bold text-slate-700">{{ $item->mahasiswa->nama }}</div>
                                            <div class="flex items-center gap-2 text-xs text-slate-500 mt-0.5">
                                                <span
                                                    class="{{ request('sort') == 'kelas' ? 'font-bold text-blue-600 bg-blue-50 px-1 rounded' : '' }}">
                                                    {{ $item->mahasiswa->kelas }}
                                                </span>
                                                <span>•</span>
                                                <span>{{ $item->mahasiswa->nim }}</span>
                                            </div>
                                        </td>

                                        <td class="p-4 text-center font-bold text-slate-700">
                                            {{ $item->total_kompensasi }}</td>

                                        <td class="p-4 text-center">
                                            @if ($item->status == 'Lunas')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Lunas</span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-700">Belum</span>
                                            @endif
                                        </td>

                                        @for ($i = 1; $i <= $jumlah_kolom; $i++)
                                            @if ($i <= $kotak_aktif)
                                                <td class="p-0 border border-slate-200 text-center relative">
                                                    <div class="w-full h-12 flex items-center justify-center">
                                                        @if (in_array($i, $item->completed_days ?? []))
                                                            <i class="fas fa-check text-emerald-500 text-lg"></i>
                                                        @else
                                                            <span class="text-slate-200 text-[10px]">•</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            @else
                                                <td class="p-0 border border-slate-800 bg-slate-900">
                                                    <div class="w-full h-12 bg-slate-900 pattern-diagonal-lines"></div>
                                                </td>
                                            @endif
                                        @endfor
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $jumlah_kolom + 3 }}" class="p-8 text-center text-slate-400">
                                            <i class="fas fa-folder-open text-3xl mb-2 opacity-50"></i>
                                            <p>Belum ada data kompensasi yang diinput.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div
                        class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-center text-xs text-slate-400">
                        Data diperbarui otomatis {{ now()->diffForHumans() }}.
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-white/80 backdrop-blur-sm border-t border-slate-200 py-8">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-slate-500 text-sm">
                    &copy; {{ date('Y') }} Rnsaputra.
                </p>
            </div>
        </footer>

    </div>
</body>

</html>
