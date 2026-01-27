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

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">

    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <div class="flex items-center gap-3">
                    <div
                        class="w-8 h-8 rounded-lg bg-linear-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md">
                        <i class="fas fa-university text-sm"></i>
                    </div>
                    <span class="font-bold text-lg tracking-tight text-slate-800">SiKompen</span>
                </div>

                <div>
                    <a href="/login"
                        class="group relative inline-flex items-center gap-2 px-6 py-2.5 bg-slate-900 text-white rounded-full text-sm font-medium hover:bg-slate-800 transition-all hover:shadow-lg hover:-translate-y-0.5">
                        <span>Login Staff</span>
                        <i class="fas fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1">

        <div class="pt-32 pb-12 px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-4 tracking-tight">
                Cek Status <span
                    class="text-sky-700">Kompensasi</span>
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Rekapan data ketidakhadiran dan kewajiban kompensasi mahasiswa secara real-time dan transparan.
            </p>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">

            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 text-lg">Daftar Mahasiswa Terkini</h3>
                    <span class="text-xs font-medium px-3 py-1 bg-blue-100 text-blue-700 rounded-full">
                        Updated: {{ date('d M Y') }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left whitespace-nowrap">
                        <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Mahasiswa</th>
                                <th class="px-6 py-4 text-center">Jumlah Alpha</th>
                                <th class="px-6 py-4 text-center">Tanggungan (Jam)</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">

                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                                            JD
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-700">John Doe</p>
                                            <p class="text-xs text-slate-500">2141720001</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-medium text-slate-600">
                                    4 Jam
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="font-bold text-emerald-600 text-lg">12</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        Belum Lunas
                                    </span>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-xs">
                                            SA
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-700">Siti Aminah</p>
                                            <p class="text-xs text-slate-500">2141720005</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-medium text-slate-600">
                                    2 Jam
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="font-bold text-emerald-600 text-lg">6</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        Belum Lunas
                                    </span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-center">
                    <p class="text-xs text-slate-400">Menampilkan data terbaru</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} Rnsaputra.
            </p>
        </div>
    </footer>
</body>

</html>
