<!doctype html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Kompensasi' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-transition {
            transition: width 0.3s ease;
        }

        body {
            font-family: 'poppins', sans-serif;
        }

        /* Animasi Custom */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out;
        }
    </style>
</head>

<body class="h-full antialiased relative text-slate-800"
    style="background-image: url('{{ asset('img/background.jpg') }}'); 
           background-size: cover; 
           background-position: center; 
           background-attachment: fixed;
           background-repeat: no-repeat;">

    <div class="absolute inset-0 bg-slate-50/90 z-0 fixed"></div>

    <div class="relative z-10 flex h-full w-full overflow-hidden flex-col md:flex-row">

        <x-sidebar />

        <main class="flex-1 overflow-auto relative w-full">
            <div class="h-full p-4 pt-20 md:p-8 md:pt-8 pb-24 md:pb-8">

                <div class="fixed top-5 right-5 z-50 flex flex-col gap-3 w-full max-w-sm pointer-events-none">

                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-x-10"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 translate-x-10"
                            class="pointer-events-auto relative overflow-hidden bg-white text-slate-700 rounded-xl shadow-2xl border-l-4 border-emerald-500 p-4 pr-10">

                            <div class="flex items-center gap-3">
                                <div class="bg-emerald-100 text-emerald-600 rounded-full p-2">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-emerald-600">Berhasil!</h4>
                                    <p class="text-xs text-slate-500">{{ session('success') }}</p>
                                </div>
                            </div>

                            <button @click="show = false"
                                class="absolute top-2 right-2 text-slate-400 hover:text-slate-600">
                                <i class="fas fa-times text-xs"></i>
                            </button>

                            <div class="absolute bottom-0 left-0 h-1 bg-emerald-500 w-full transition-all duration-[3000ms] ease-linear"
                                x-init="setTimeout(() => $el.style.width = '0%', 50)">
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-x-10"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 translate-x-10"
                            class="pointer-events-auto relative overflow-hidden bg-white text-slate-700 rounded-xl shadow-2xl border-l-4 border-red-500 p-4 pr-10">

                            <div class="flex items-center gap-3">
                                <div class="bg-red-100 text-red-600 rounded-full p-2 animate-pulse">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-red-600">Terjadi Kesalahan</h4>
                                    <p class="text-xs text-slate-500">{{ session('error') }}</p>
                                </div>
                            </div>

                            <button @click="show = false"
                                class="absolute top-2 right-2 text-slate-400 hover:text-slate-600">
                                <i class="fas fa-times text-xs"></i>
                            </button>

                            <div class="absolute bottom-0 left-0 h-1 bg-red-500 w-full transition-all duration-[5000ms] ease-linear"
                                x-init="setTimeout(() => $el.style.width = '0%', 50)">
                            </div>
                        </div>
                    @endif

                </div>
                {{ $slot }}



            </div>

        </main>
    </div>

    @stack('scripts')
</body>

</html>
