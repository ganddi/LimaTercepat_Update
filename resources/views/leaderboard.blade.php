<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-color: #07428a;
        }

        body {
            background-color: #020617;
            background-image: radial-gradient(circle at top right, #07428a44, #020617);
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .text-primary { color: var(--primary-color); }
        .bg-primary { background-color: var(--primary-color); }
        .border-primary { border-color: var(--primary-color); }
    </style>
</head>

<body class="antialiased text-white font-sans min-h-screen pb-20">

    <div class="max-w-6xl mx-auto px-6 py-10">

        <div class="text-center mb-16">
            <h1 class="text-4xl font-extrabold tracking-tight text-white mb-2">
                <span class="text-white">Leaderboard</span>
            </h1>
            <p class="text-slate-400">Akumulasi Poin Kehadiran Tercepat Januari 2026</p>
        </div>

        <div class="flex flex-col md:flex-row items-center md:items-end justify-center gap-6 md:gap-8 mb-16">

            @if (isset($top5[1]))
                <div class="flex flex-col items-center w-full md:w-64 group order-2 md:order-1">
                    <div class="relative mb-4 transition-transform duration-300 group-hover:-translate-y-2">
                        <img src="{{ $top5[1]['image'] }}"
                            class="w-32 h-32 rounded-full border-4 border-primary shadow-2xl object-cover">
                        <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-primary text-white font-black px-4 py-1 rounded-full text-sm">
                            2
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-center">{{ $top5[1]['name'] }}</h2>
                    <div class="text-primary text-3xl font-black mb-1">
                        {{ $top5[1]['score'] }} <span class="text-sm font-normal text-slate-500 uppercase">Pts</span>
                    </div>
                </div>
            @endif

            @if (isset($top5[0]))
                <div class="flex flex-col items-center w-full md:w-72 pb-0 md:pb-10 group order-1 md:order-2 z-10">
                    <div class="relative mb-4 transition-transform duration-300 group-hover:-translate-y-3">
                        <img src="{{ $top5[0]['image'] }}"
                            class="w-44 h-44 rounded-full border-4 border-yellow-500 shadow-[0_0_50px_rgba(234,179,8,0.2)] object-cover">
                        <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-yellow-500 text-black font-black px-6 py-1.5 rounded-full text-lg">
                            1
                        </div>
                    </div>
                    <h2 class="text-2xl font-black text-center">{{ $top5[0]['name'] }}</h2>
                    <div class="text-yellow-500 text-5xl font-black mb-1">
                        {{ $top5[0]['score'] }} <span class="text-sm font-normal text-slate-500 uppercase">Pts</span>
                    </div>
                </div>
            @endif

            @if (isset($top5[2]))
                <div class="flex flex-col items-center w-full md:w-64 group order-3 md:order-3">
                    <div class="relative mb-4 transition-transform duration-300 group-hover:-translate-y-2">
                        <img src="{{ $top5[2]['image'] }}"
                            class="w-32 h-32 rounded-full border-4 border-emerald-500 shadow-2xl object-cover">
                        <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-emerald-500 text-white font-black px-4 py-1 rounded-full text-sm">
                            3
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-center">{{ $top5[2]['name'] }}</h2>
                    <div class="text-emerald-500 text-3xl font-black mb-1">
                        {{ $top5[2]['score'] }} <span class="text-sm font-normal text-slate-500 uppercase">Pts</span>
                    </div>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-20">
            @foreach (array_slice($top5, 3, 2) as $index => $item)
                <div class="glass-card rounded-2xl p-6 flex items-center justify-between transition-all hover:border-primary/50">
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <img src="{{ $item['image'] }}" class="w-20 h-20 rounded-full border-2 border-slate-700 object-cover">
                            <div class="absolute -top-2 -left-2 bg-slate-800 text-white w-8 h-8 flex items-center justify-center rounded-full font-bold border border-slate-600">
                                {{ $index + 4 }}
                            </div>
                        </div>
                        <h3 class="text-xl font-bold">{{ $item['name'] }}</h3>
                    </div>
                    <div class="text-right">
                        <span class="text-2xl font-black block text-primary">{{ $item['score'] }}</span>
                        <span class="text-xs text-slate-500 uppercase font-bold">Points</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="glass-card rounded-3xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-500 text-sm uppercase tracking-wider bg-slate-900/50">
                            <th class="px-8 py-5 font-semibold">Rank</th>
                            <th class="px-8 py-5 font-semibold">Karyawan</th>
                            <th class="px-8 py-5 font-semibold text-right">Poin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach ($others as $index => $item)
                            <tr class="hover:bg-white/5 transition-colors group">
                                <td class="px-8 py-4 font-bold text-slate-500 group-hover:text-primary">
                                    #{{ $loop->iteration + 5 }}
                                </td>
                                <td class="px-8 py-4">
                                    <span class="font-bold">{{ $item['name'] }}</span>
                                </td>
                                <td class="px-8 py-4 text-right">
                                        {{ $item['score'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>