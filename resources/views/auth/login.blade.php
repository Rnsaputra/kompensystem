<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SiKompen</title>

    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'poppins', sans-serif;
        }
    </style>
</head>

<body
    class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-center items-center py-12 sm:px-6 lg:px-8 bg-[url('https://grainy-gradients.vercel.app/noise.svg')]">



    <div class="sm:mx-auto sm:w-full sm:max-w-md">

        <div class="text-center mb-8">
            <div
                class="mx-auto w-12 h-12 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg mb-4">
                <i class="fas fa-university text-xl"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Admin Login
            </h2>
            <p class="mt-2 text-sm text-slate-600">
                Masuk untuk mengelola data kompensasi
            </p>
        </div>

        <div class="bg-white py-8 px-4 shadow-xl shadow-slate-200/50 sm:rounded-2xl sm:px-10 border border-slate-100">

            <form class="space-y-6" action="{{ route('login.auth') }}" method="POST">
                @csrf @if ($errors->any())
                    <div
                        class="bg-red-50 text-red-600 p-3 rounded-lg text-sm flex items-start gap-2 border border-red-100">
                        <i class="fas fa-circle-exclamation mt-0.5"></i>
                        <div>
                            <span class="font-semibold">Login Gagal:</span>
                            <ul class="list-disc list-inside mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700">
                        Email Address
                    </label>
                    <div class="mt-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-slate-400"></i>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="appearance-none block w-full pl-10 pr-3 py-2.5 border border-slate-300 rounded-xl shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition"
                            placeholder="admin@polines.ac.id">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700">
                        Password
                    </label>
                    <div class="mt-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-slate-400"></i>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none block w-full pl-10 pr-3 py-2.5 border border-slate-300 rounded-xl shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition"
                            placeholder="••••••••">
                    </div>
                </div>
                <div class="gap-2 flex">

                    <a href="{{ route('landing') }}"
                        class="group relative w-1/3 flex justify-center py-2.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-red-900 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fa-solid fa-arrow-left text-slate-400 group-hover:text-slate-300 transition"></i>
                        </span>
                        Kembali
                    </a>
                    <button type="submit"
                        class="group relative w-2/3  flex justify-center py-2.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-sign-in-alt text-slate-400 group-hover:text-slate-300 transition"></i>
                        </span>
                        Sign In
                    </button>
                </div>
            </form>

        </div>

        <p class="mt-6 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} Rnsaputra.
        </p>
    </div>*-

</body>

</html>
