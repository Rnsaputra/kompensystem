<x-layout>

    <div id="view-dashboard" class="view-content animate-fade-in space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Overview</h2>
            <p class="text-slate-500">Ringkasan statistik kompensasi</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Mahasiswa</p>
                <h3 class="text-3xl font-bold text-slate-800" id="stat-total">0</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-amber-600 text-xs font-bold uppercase tracking-wider mb-1">Total Alpha</p>
                <h3 class="text-3xl font-bold text-slate-800" id="stat-alpha">0</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-emerald-600 text-xs font-bold uppercase tracking-wider mb-1">Total Kompen (Jam)</p>
                <h3 class="text-3xl font-bold text-slate-800" id="stat-kompensasi">0</h3>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
            <h3 class="font-bold text-slate-800 mb-4">Data Terbaru</h3>
            <div id="recent-data-list" class="space-y-3"></div>
            <div id="empty-dashboard" class="text-center py-8 text-slate-400 hidden">Belum ada data.</div>
        </div>
    </div>

    <div id="view-input" class="view-content hidden animate-fade-in space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Input Data</h2>
            <p class="text-slate-500">Form perhitungan kompensasi</p>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 max-w-2xl">
            <form id="form-kompensasi" class="space-y-5">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama</label>
                        <input type="text" id="nama" required
                            class="w-full px-4 py-2 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">NIM</label>
                        <input type="text" id="nim" required
                            class="w-full px-4 py-2 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Jml Alpha</label>
                        <input type="number" id="alpha" min="0" required
                            class="w-full px-4 py-2 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Pengali</label>
                        <input type="number" id="pengali" value="3" min="1" required
                            class="w-full px-4 py-2 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <div class="bg-blue-50 p-4 rounded-xl flex justify-between items-center text-blue-900">
                    <span class="font-medium">Total Kompen:</span>
                    <span class="font-bold text-xl"><span id="preview-hasil">0</span> Jam</span>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Simpan</button>
                    <button type="reset"
                        class="px-6 bg-slate-100 text-slate-600 py-3 rounded-xl font-semibold hover:bg-slate-200 transition">Reset</button>
                </div>
            </form>
        </div>
    </div>

    <div id="view-data" class="view-content hidden animate-fade-in space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Data Mahasiswa</h2>
                <p class="text-slate-500">Semua data yang tersimpan</p>
            </div>
            <input type="text" id="search-input" placeholder="Cari..."
                class="px-4 py-2 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold">
                    <tr>
                        <th class="p-4">Mahasiswa</th>
                        <th class="p-4 text-center">Alpha</th>
                        <th class="p-4 text-center">Kompen</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="divide-y divide-slate-100">
                </tbody>
            </table>
            <div id="empty-state" class="hidden p-8 text-center text-slate-500">Data tidak ditemukan</div>
        </div>
    </div>

    <x-slot:scripts>
        <script src="/_sdk/data_sdk.js"></script>
        <script>
            let allData = [];

            // 1. Navigation Logic
            window.switchView = (view) => {
                // Sembunyikan semua view
                document.querySelectorAll('.view-content').forEach(el => el.classList.add('hidden'));
                // Tampilkan view target
                document.getElementById(`view-${view}`).classList.remove('hidden');

                // Update Style Tombol Sidebar
                document.querySelectorAll('.nav-btn').forEach(btn => {
                    const isActive = btn.dataset.view === view;
                    btn.className = isActive ?
                        'nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left text-sm font-medium transition-all duration-200 hover:translate-x-1 bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg shadow-blue-500/30 text-white' :
                        'nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left text-sm font-medium transition-all duration-200 hover:translate-x-1 text-slate-400 hover:text-white hover:bg-white/10';
                });

                if (view === 'dashboard') renderDashboard();
            };

            // 2. Form Logic
            const form = document.getElementById('form-kompensasi');
            const updateCalc = () => {
                const a = document.getElementById('alpha').value || 0;
                const p = document.getElementById('pengali').value || 0;
                document.getElementById('preview-hasil').textContent = a * p;
            };

            document.getElementById('alpha').addEventListener('input', updateCalc);
            document.getElementById('pengali').addEventListener('input', updateCalc);

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const data = {
                    nama: document.getElementById('nama').value,
                    nim: document.getElementById('nim').value,
                    jumlah_alpha: parseInt(document.getElementById('alpha').value),
                    pengali_kompensasi: parseInt(document.getElementById('pengali').value),
                    total_kompensasi: document.getElementById('alpha').value * document.getElementById(
                        'pengali').value,
                    created_at: new Date().toISOString()
                };

                // Simpan ke SDK (Mock)
                if (window.dataSdk) await window.dataSdk.create(data);
                form.reset();
                updateCalc();
                alert('Data Disimpan!');
                switchView('data');
            });

            // 3. Render Logic
            const renderDashboard = () => {
                const list = document.getElementById('recent-data-list');
                const empty = document.getElementById('empty-dashboard');

                if (!allData.length) {
                    list.innerHTML = '';
                    empty.classList.remove('hidden');
                    return;
                }
                empty.classList.add('hidden');

                // Update Stats
                const totalAlpha = allData.reduce((acc, curr) => acc + curr.jumlah_alpha, 0);
                const totalKompen = allData.reduce((acc, curr) => acc + curr.total_kompensasi, 0);
                document.getElementById('stat-total').innerText = allData.length;
                document.getElementById('stat-alpha').innerText = totalAlpha;
                document.getElementById('stat-kompensasi').innerText = totalKompen;

                // Render List Dashboard
                list.innerHTML = allData.slice(0, 3).map(item => `
                    <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl">
                        <div>
                            <p class="font-bold text-slate-700">${item.nama}</p>
                            <p class="text-xs text-slate-500">${item.nim}</p>
                        </div>
                        <span class="text-emerald-600 font-bold text-sm">${item.total_kompensasi} Jam</span>
                    </div>
                `).join('');
            };

            const renderTable = (filter = '') => {
                const tbody = document.getElementById('table-body');
                const filtered = allData.filter(d => d.nama.toLowerCase().includes(filter.toLowerCase()) || d.nim.includes(
                    filter));

                if (!filtered.length) {
                    tbody.innerHTML = '';
                    document.getElementById('empty-state').classList.remove('hidden');
                    return;
                }
                document.getElementById('empty-state').classList.add('hidden');

                tbody.innerHTML = filtered.map(item => `
                    <tr class="border-b border-slate-50 hover:bg-blue-50 transition">
                        <td class="p-4">
                            <p class="font-bold text-slate-700">${item.nama}</p>
                            <p class="text-xs text-slate-500">${item.nim}</p>
                        </td>
                        <td class="p-4 text-center text-amber-600 font-bold">${item.jumlah_alpha}</td>
                        <td class="p-4 text-center text-emerald-600 font-bold">${item.total_kompensasi}</td>
                        <td class="p-4 text-center">
                            <button onclick="hapusData('${item.__backendId}')" class="text-red-400 hover:text-red-600">Hapus</button>
                        </td>
                    </tr>
                `).join('');
            };

            window.hapusData = async (id) => {
                if (confirm('Hapus data ini?')) {
                    if (window.dataSdk) await window.dataSdk.delete({
                        __backendId: id
                    });
                }
            };

            document.getElementById('search-input').addEventListener('input', (e) => renderTable(e.target.value));

            // Init Data
            if (window.dataSdk) {
                window.dataSdk.init({
                    onDataChanged: (data) => {
                        allData = data.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                        renderDashboard();
                        renderTable(document.getElementById('search-input').value);
                    }
                });
            }
        </script>
    </x-slot:scripts>

</x-layout>
