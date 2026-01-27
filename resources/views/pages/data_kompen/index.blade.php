<x-layout title="Data Kompensasi">
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Data Mahasiswa</h2>
                <p class="text-slate-500">Kelola data kompensasi yang tersimpan</p>
            </div>
            <button onclick="openModal()"
                class="px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider">
                        <tr>
                            <th class="p-4 border-b">Nama Mahasiswa</th>
                            <th class="p-4 border-b text-center">Jml Alpha</th>
                            <th class="p-4 border-b text-center">Total Kompen</th>
                            <th class="p-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4" colspan="4" class="text-center text-slate-400 py-8">
                                <div class="text-center py-6">
                                    Belum ada data.
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="inputModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-white/50 backdrop-blur-md hidden opacity-0 transition-opacity duration-300">

        <div class="bg-white w-full max-w-2xl mx-4 rounded-2xl shadow-2xl border border-slate-100 transform scale-95 transition-transform duration-300"
            id="modalContent">

            <div class="flex justify-between items-center p-6 border-b border-slate-100">
                <h3 class="text-xl font-bold text-slate-800">Input Data Baru</h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-red-500 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="p-6">
                <form action="{{ route('kompensasi.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Mahasiswa</label>
                            <input type="text" name="nama" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">NIM</label>
                            <input type="text" name="nim" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Kelas</label>
                            <input type="text" name="jumlah_alpha" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Alpha</label>
                            <input type="number" name="jumlah_alpha" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" onclick="closeModal()"
                            class="flex-1 py-3.5 bg-slate-100 text-slate-600 rounded-xl font-semibold hover:bg-slate-200 transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1 transition duration-200">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>

<script>
    const modal = document.getElementById('inputModal');
    const modalContent = document.getElementById('modalContent');

    function openModal() {
        modal.classList.remove('hidden');
        // Sedikit delay biar animasi CSS jalan
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
        }, 300); // Sesuaikan dengan duration-300
    }

    // Tutup modal jika klik di luar area konten (klik background)
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Otomatis buka modal jika ada Error Validasi dari Laravel
    @if ($errors->any())
        openModal();
    @endif
</script>
