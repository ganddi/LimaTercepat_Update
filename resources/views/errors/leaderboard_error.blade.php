<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Sedang Bermasalah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --primary-color: #07428a; }
        body {
            background-color: #020617;
            background-image: radial-gradient(circle at top right, #450a0a, #020617);
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="antialiased text-white font-sans min-h-screen flex items-center justify-center p-6">

    <div class="glass-card w-full max-w-md p-8 rounded-3xl shadow-2xl text-center">
        <div class="text-red-500 mb-6">
            <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        
        <h1 class="text-3xl font-black text-white mb-4">Mohon Maaf</h1>
        <p class="text-slate-400 mb-8">{{ $message ?? 'Sistem sedang tidak dapat diakses saat ini. Tim kami sedang menanganinya.' }}</p>
        
        <a href="{{ route('leaderboard') }}" class="inline-block w-full bg-[#07428a] hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-lg shadow-blue-900/20">
            Coba Muat Ulang
        </a>
    </div>

</body>
</html>
