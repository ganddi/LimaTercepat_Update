<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Leaderboard Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --primary-color: #07428a; }
        body {
            background-color: #020617;
            background-image: radial-gradient(circle at top right, #07428a44, #020617);
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="antialiased text-white font-sans min-h-screen flex items-center justify-center p-6">

    <div class="glass-card w-full max-w-md p-8 rounded-3xl shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-white mb-2">Secure Login</h1>
            <p class="text-slate-400">Silakan masuk untuk melihat Leaderboard</p>
        </div>

        @if($errors->any())
            <div class="bg-red-500/20 border border-red-500/50 text-red-200 p-4 rounded-xl mb-6 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="username" class="block text-sm font-semibold text-slate-300 mb-2">Username</label>
                <input type="text" id="username" name="username" required
                    class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors"
                    placeholder="Masukkan username">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-300 mb-2">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors"
                    placeholder="Masukkan password">
            </div>

            <button type="submit"
                class="w-full bg-[#07428a] hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-lg shadow-blue-900/20">
                Masuk ke Sistem
            </button>
        </form>
    </div>

</body>
</html>
