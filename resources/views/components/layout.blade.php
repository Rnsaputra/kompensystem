<!doctype html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Kompensasi' }}</title>

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Class tambahan untuk animasi sidebar jika diperlukan */
        .sidebar-transition {
            transition: width 0.3s ease;
        }
    </style>
</head>

<body class="h-full bg-slate-50 antialiased">

    <div class="flex h-full w-full overflow-hidden flex-col md:flex-row bg-gradient-to-br from-slate-50 to-slate-200">

        <x-sidebar />

        <main class="flex-1 overflow-auto relative w-full">
            <div class="h-full p-4 pt-20 md:p-8 md:pt-8 pb-24 md:pb-8">

                @if (session('success'))
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>

</html>
