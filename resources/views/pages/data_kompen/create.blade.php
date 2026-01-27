<x-layout title="Input Data Baru">
    <div class="space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Input Data Mahasiswa</h2>
            <p class="text-slate-500">Silakan isi formulir di bawah ini</p>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 max-w-2xl">
            <form action="{{ route('kompensasi.store') }}" method="POST" class="space-y-5">
                @csrf <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Mahasiswa</label>
                        <input type="text" name="nama" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">NIM</label>
                        <input type="number" name="nim" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Alpha</label>
                        <input type="number" name="jumlah_alpha" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3.5 rounded-xl font-bold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1 transition duration-200">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
