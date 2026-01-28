<x-layout title="Data Kompensasi">
    <div class="space-y-6">

        <div class="flex flex-col lg:flex-row gap-6 items-start">

            <div class="flex-1 w-full">
                <h2 class="text-2xl font-bold text-slate-800">Data Mahasiswa</h2>
                <p class="text-slate-500 mb-4">Kelola data kompensasi yang tersimpan</p>

                <div class="flex flex-wrap items-center gap-3">
                    <button onclick="openModal()"
                        class="px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition flex items-center gap-2">
                        <i class="fas fa-plus"></i> Input Data
                    </button>

                    <form action="{{ route('kompensasi.index') }}" method="GET" class="flex items-center">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-sort text-slate-400 text-xs"></i>
                            </div>
                            <select name="sort" onchange="this.form.submit()"
                                class="pl-8 pr-4 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer shadow-sm hover:border-blue-400 transition font-medium appearance-none">
                                <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Nama (A-Z)
                                </option>
                                <option value="kelas" {{ request('sort') == 'kelas' ? 'selected' : '' }}>Kelas</option>
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
                </div>
            </div>

            <div class="w-full lg:w-80 bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                <div class="flex items-center gap-2 mb-3 border-b border-slate-100 pb-2">
                    <div class="w-6 h-6 rounded bg-amber-100 text-amber-600 flex items-center justify-center text-xs">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm">Pengaturan Rumus</h3>
                </div>

                <form action="{{ route('kompensasi.update_rumus') }}" method="POST" class="flex gap-2 items-end">
                    @csrf
                    <div class="flex-1">
                        <label class="text-xs text-slate-500 font-medium ml-1">1 Alpha dikali</label>
                        <div class="relative mt-1">
                            <input type="number" name="pengali_baru" value="{{ $nilai_pengali }}" min="1"
                                required
                                class="w-full pl-3 pr-8 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-bold text-slate-700 focus:ring-2 focus:ring-amber-500 outline-none">
                            <span class="absolute right-3 top-2 text-xs text-slate-400 font-medium">Jam</span>
                        </div>
                    </div>
                    <button type="submit"
                        class="py-2 px-3 bg-slate-800 text-white rounded-lg text-sm hover:bg-slate-700 transition">
                        Update
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider">
                        <tr>
                            <th class="p-4 border-b">
                                <div class="flex items-center gap-2">
                                    Mahasiswa
                                    @if (request('sort') == 'kelas')
                                        <span class="text-[10px] bg-blue-100 text-blue-600 px-1.5 py-0.5 rounded">Sorted
                                            by Kelas</span>
                                    @endif
                                </div>
                            </th>
                            <th class="p-4 border-b text-center">Jml Alpha</th>
                            <th class="p-4 border-b text-center">Rumus</th>
                            <th class="p-4 border-b text-center">
                                <div class="flex items-center justify-center gap-1">
                                    Total Kompen
                                    @if (request('sort') == 'jam_tinggi')
                                        <i class="fas fa-caret-down text-blue-600"></i>
                                    @elseif(request('sort') == 'jam_rendah')
                                        <i class="fas fa-caret-up text-blue-600"></i>
                                    @endif
                                </div>
                            </th>
                            <th class="p-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($data as $item)
                            <tr class="hover:bg-slate-50/80 transition group">
                                <td class="p-4">
                                    <div class="font-bold text-slate-700">{{ $item->mahasiswa->nama }}</div>
                                    <div class="flex items-center gap-2 text-xs text-slate-500 mt-0.5">
                                        <span>{{ $item->mahasiswa->nim }}</span>
                                        <span>•</span>
                                        <span
                                            class="{{ request('sort') == 'kelas' ? 'font-bold text-blue-600 bg-blue-50 px-1 rounded' : '' }}">
                                            {{ $item->mahasiswa->kelas }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-4 text-center font-semibold">{{ $item->jumlah_alpha }}</td>
                                <td class="p-4 text-center text-xs text-slate-400">x {{ $item->pengali }}</td>
                                <td class="p-4 text-center">
                                    <span
                                        class="bg-emerald-100 text-emerald-700 font-bold px-3 py-1 rounded-lg text-sm">
                                        {{ $item->total_kompensasi }} Jam
                                    </span>
                                </td>
                                <td class="p-4 text-center flex justify-center gap-2">
                                    <button
                                        onclick="document.getElementById('editModal-{{ $item->id }}').classList.remove('hidden')"
                                        class="text-amber-500 hover:text-amber-600 transition bg-amber-50 p-2 rounded-lg">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('kompensasi.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data {{ $item->mahasiswa->nama }}?');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="text-red-400 hover:text-red-600 transition bg-red-50 p-2 rounded-lg">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Edit Modal --}}
                            <div id="editModal-{{ $item->id }}"
                                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden backdrop-blur-sm">
                                <div
                                    class="bg-white w-full max-w-lg mx-4 rounded-2xl shadow-2xl p-6 relative animate-fade-in-down">
                                    <div class="flex justify-between items-center mb-6 border-b pb-2">
                                        <h3 class="text-lg font-bold text-slate-800">Edit Data Kompensasi</h3>
                                        <button type="button"
                                            onclick="document.getElementById('editModal-{{ $item->id }}').classList.add('hidden')"
                                            class="text-slate-400 hover:text-red-500">
                                            <i class="fas fa-times text-xl"></i>
                                        </button>
                                    </div>

                                    <form action="{{ route('kompensasi.update', $item->id) }}" method="POST"
                                        class="space-y-4">
                                        @csrf @method('PUT')
                                        <div>
                                            <label
                                                class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama</label>
                                            <input type="text" name="nama" value="{{ $item->mahasiswa->nama }}"
                                                required
                                                class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-amber-400 outline-none">
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label
                                                    class="block text-xs font-bold text-slate-500 uppercase mb-1">NIM</label>
                                                <input type="text" name="nim"
                                                    value="{{ $item->mahasiswa->nim }}" required
                                                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-amber-400 outline-none">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-bold text-slate-500 uppercase mb-1">Kelas</label>
                                                <input type="text" name="kelas"
                                                    value="{{ $item->mahasiswa->kelas }}" required
                                                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-amber-400 outline-none">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Jumlah
                                                Alpha</label>
                                            <div class="relative">
                                                <input type="number" name="jumlah_alpha"
                                                    value="{{ $item->jumlah_alpha }}" min="0" required
                                                    class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-amber-400 outline-none font-bold">
                                                <span
                                                    class="absolute right-4 top-2 text-xs text-slate-400 font-bold">JAM</span>
                                            </div>
                                        </div>
                                        <div class="flex gap-2 pt-2">
                                            <button type="button"
                                                onclick="document.getElementById('editModal-{{ $item->id }}').classList.add('hidden')"
                                                class="flex-1 py-2 bg-slate-100 text-slate-600 rounded-lg font-semibold hover:bg-slate-200">Batal</button>
                                            <button type="submit"
                                                class="flex-1 py-2 bg-amber-500 text-white rounded-lg font-bold hover:bg-amber-600 shadow-lg shadow-amber-500/30">Update
                                                Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-folder-open text-3xl mb-2 opacity-50"></i>
                                        <p>Belum ada data mahasiswa.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Input --}}
    <div id="inputModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-white/50 backdrop-blur-md hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white w-full max-w-lg mx-4 rounded-2xl shadow-2xl border border-slate-100 transform scale-95 transition-transform duration-300"
            id="modalContent">
            <div class="flex justify-between items-center p-6 border-b border-slate-100">
                <h3 class="text-xl font-bold text-slate-800">Input Data Mahasiswa</h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-red-500 transition"><i
                        class="fas fa-times text-xl"></i></button>
            </div>
            <div class="p-6">
                <form action="{{ route('kompensasi.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-start gap-3">
                        <div
                            class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-calculator text-xs"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-blue-800">Rumus Aktif</h4>
                            <p class="text-xs text-blue-600 mt-0.5">Otomatis dikali <span
                                    class="font-bold">{{ $nilai_pengali }}</span>.</p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Mahasiswa</label>
                        <input type="text" name="nama" required placeholder="Nama Lengkap"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition font-medium">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">NIM</label>
                            <input type="text" name="nim" required placeholder="Nomor Induk"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition font-medium">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Kelas</label>
                            <input type="text" name="kelas" required placeholder="Cth: TI-3A"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition font-medium">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Alpha</label>
                        <div class="relative">
                            <input type="number" name="jumlah_alpha" id="inputAlpha" required min="1"
                                placeholder="0"
                                class="w-full pl-4 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition font-bold text-lg text-slate-800">
                            <span class="absolute right-4 top-3.5 text-slate-400 text-sm font-medium">Jam</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-2 px-1">
                        <span class="text-sm text-slate-500 font-medium">Total Kompensasi</span>
                        <div class="text-right">
                            <span class="block text-2xl font-bold text-slate-800 tracking-tight">
                                <span id="displayTotal">0</span> <span
                                    class="text-sm text-slate-500 font-normal">Jam</span>
                            </span>
                        </div>
                    </div>
                    <div class="pt-4 flex gap-3">
                        <button type="button" onclick="closeModal()"
                            class="flex-1 py-3.5 bg-slate-100 text-slate-600 rounded-xl font-semibold hover:bg-slate-200 transition">Batal</button>
                        <button type="submit"
                            class="flex-1 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1 transition duration-200">Simpan
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>

<script>
    // Script Modal
    const modal = document.getElementById('inputModal');
    const modalContent = document.getElementById('modalContent');

    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Script Estimasi Hitungan (Live) di Modal
    const inputAlpha = document.getElementById('inputAlpha');
    // PERBAIKAN: Pastikan ID ini cocok dengan HTML (displayTotal)
    const displayTotal = document.getElementById('displayTotal');
    const PENGALI_SAAT_INI = {{ $nilai_pengali }};

    inputAlpha.addEventListener('input', function() {
        const alpha = parseInt(this.value) || 0;
        displayTotal.innerText = alpha * PENGALI_SAAT_INI;
    });
</script>
