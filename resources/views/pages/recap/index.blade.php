<x-layout title="Rekapitulasi Kompensasi">
    <div class="space-y-6">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-6">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">Recap Kompensasi</h2>
                <p class="text-sm text-slate-500 mt-1">Visualisasi beban kompensasi (1 Kotak = 8 Jam)</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">

                <form action="{{ route('recap.index') }}" method="GET" class="flex items-center">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-sort text-slate-400 text-xs"></i>
                        </div>
                        <select name="sort" onchange="this.form.submit()"
                            class="pl-8 pr-4 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none cursor-pointer shadow-sm hover:border-blue-400 transition-colors appearance-none font-medium">
                            <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Nama (A-Z)
                            </option>
                            <option value="kelas" {{ request('sort') == 'kelas' ? 'selected' : '' }}>Kelas
                            </option>
                            <option value="jam_tinggi" {{ request('sort') == 'jam_tinggi' ? 'selected' : '' }}>Jam
                                Tertinggi</option>
                            <option value="jam_rendah" {{ request('sort') == 'jam_rendah' ? 'selected' : '' }}>Jam
                                Terendah</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                        </div>
                    </div>
                </form>
                <a href="{{ route('recap.export') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 text-white text-sm font-semibold rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transition-all duration-200">
                    <i class="fas fa-file-excel"></i>
                    <span class="hidden sm:inline">Unduh Excel</span>
                </a>

                <a href="{{ route('kompensasi.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-100 text-slate-600 text-sm font-semibold rounded-xl hover:bg-slate-200 hover:text-slate-800 transition-all duration-200">
                    <i class="fas fa-arrow-left"></i>
                    <span class="hidden sm:inline">Kembali</span>
                </a>

            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                            <th
                                class="p-4 text-left sticky left-0 bg-slate-50 z-10 border-r border-slate-200 shadow-sm min-w-[200px]">
                                <div class="flex items-center gap-2">
                                    Mahasiswa
                                    @if (request('sort') == 'kelas')
                                        <span class="text-[10px] bg-blue-100 text-blue-600 px-1.5 py-0.5 rounded">Sorted
                                            by Kelas</span>
                                    @endif
                                </div>
                            </th>

                            <th class="p-4 text-center min-w-[80px]">
                                <div class="flex items-center justify-center gap-1">
                                    Total
                                    @if (request('sort') == 'jam_tinggi')
                                        <i class="fas fa-caret-down text-blue-600"></i>
                                    @elseif(request('sort') == 'jam_rendah')
                                        <i class="fas fa-caret-up text-blue-600"></i>
                                    @endif
                                </div>
                            </th>

                            @for ($i = 1; $i <= $jumlah_kolom; $i++)
                                <th class="p-2 text-center min-w-[50px] border-l border-slate-100">
                                    D{{ $i }}
                                </th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($data as $item)

                            @php
                                $kotak_aktif = ceil($item->total_kompensasi / 8);
                            @endphp

                            <tr class="hover:bg-slate-50/50 transition group">
                                <td
                                    class="p-4 sticky left-0 bg-white z-10 border-r border-slate-100 group-hover:bg-slate-50/50 transition">
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

                                <td class="p-4 text-center font-bold text-blue-600 bg-blue-50/30">
                                    {{ $item->total_kompensasi }}
                                </td>

                                @for ($i = 1; $i <= $jumlah_kolom; $i++)
                                    @if ($i <= $kotak_aktif)
                                        @php
                                            $isChecked = in_array($i, $item->completed_days ?? []);
                                        @endphp

                                        <td class="p-0 border border-slate-200 text-center cursor-pointer hover:bg-slate-50 transition relative"
                                            onclick="toggleCheck({{ $item->id }}, {{ $i }})">
                                            <div class="w-full h-12 flex items-center justify-center">
                                                <i id="icon-{{ $item->id }}-{{ $i }}"
                                                    class="fas fa-check text-emerald-500 text-xl transition-transform duration-200 {{ $isChecked ? 'scale-100' : 'scale-0' }}">
                                                </i>
                                            </div>
                                        </td>
                                    @else
                                        <td class="p-0 border border-slate-800 bg-slate-900"></td>
                                    @endif
                                @endfor

                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $jumlah_kolom + 2 }}" class="p-8 text-center text-slate-400">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-search text-3xl mb-2 opacity-50"></i>
                                        <p>Data tidak ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 bg-slate-50 border-t border-slate-100 text-xs text-slate-500 flex flex-wrap gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 border border-slate-300 bg-white rounded-sm"></div>
                    <span>Tanggungan (8 Jam/Kotak)</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-slate-900 rounded-sm"></div>
                    <span>Bebas Tanggungan</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-check text-emerald-500"></i>
                    <span>Selesai Dikerjakan</span>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script>
    function toggleCheck(id, day) {
        const icon = document.getElementById(`icon-${id}-${day}`);

        // 1. Optimistic UI Update
        const isChecked = icon.classList.contains('scale-100');
        if (isChecked) {
            icon.classList.remove('scale-100');
            icon.classList.add('scale-0');
        } else {
            icon.classList.remove('scale-0');
            icon.classList.add('scale-100');
        }

        // 2. CSRF Token
        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        if (!tokenMeta) return alert('CSRF Token Error');
        const token = tokenMeta.getAttribute('content');

        // 3. Request
        fetch('{{ route('recap.toggle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    id: id,
                    day: day
                })
            })
            .then(res => res.json())
            .then(data => console.log('Saved:', data))
            .catch(err => {
                console.error(err);
                alert('Gagal menyimpan! Periksa koneksi internet.');
                // Revert jika gagal
                if (isChecked) {
                    icon.classList.add('scale-100');
                    icon.classList.remove('scale-0');
                } else {
                    icon.classList.add('scale-0');
                    icon.classList.remove('scale-100');
                }
            });
    }
</script>
