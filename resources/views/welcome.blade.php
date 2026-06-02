<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Word Battle</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>/* fallback inline css */</style>
        @endif
    </head>
    <body>

        <div class="min-h-screen bg-[#1b1b18] text-white flex flex-col justify-between antialiased selection:bg-orange-500 selection:text-white">
            
            <header class="px-6 py-4 max-w-6xl w-full mx-auto flex justify-between items-center border-b border-zinc-800">
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-black tracking-wider text-orange-500">🔠 WORD<span class="text-white">BATTLE</span></span>
                </div>
                <div class="flex items-center gap-4 text-sm text-gray-400">
                    <span class="flex items-center gap-1.5">
                        <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        1,248 Online
                    </span>
                </div>
            </header>

            <main class="flex-1 flex flex-col items-center justify-center p-6 text-center max-w-xl mx-auto w-full">
                
                <span class="px-3 py-1 text-xs uppercase font-semibold tracking-widest text-orange-400 bg-orange-950/40 border border-orange-900/50 rounded-full mb-6">
                    ⚔️ Real-Time 1v1 Word Arena
                </span>

                <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-tight mb-4">
                    Two Minds. One Word.<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-500">Ultimate Bragging Rights.</span>
                </h1>
                
                <p class="text-gray-400 text-base sm:text-lg mb-10 leading-relaxed">
                    Face off against an opponent in a live race to crack the hidden word. Every guess yields critical clues. Will you outsmart them or get spoken?
                </p>

                <div class="w-full max-w-sm mb-12">
                    <button class="w-full py-4 px-6 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-black font-black text-lg rounded-xl shadow-lg shadow-orange-500/20 active:scale-98 transition transform duration-150 tracking-wide cursor-pointer flex items-center justify-center gap-3">
                        <span>⚔️</span> FIND A MATCH <span>⚔️</span>
                    </button>
                </div>

                <div class="grid grid-cols-3 gap-4 w-full border border-zinc-800 bg-zinc-900/30 p-4 rounded-xl text-center backdrop-blur-sm">
                    <div>
                        <p class="text-2xl font-bold text-white">42.9k</p>
                        <p class="text-[11px] uppercase tracking-wider text-gray-500 font-semibold mt-1">Duels Today</p>
                    </div>
                    <div class="border-x border-zinc-800">
                        <p class="text-2xl font-bold text-orange-400">24 🔥</p>
                        <p class="text-[11px] uppercase tracking-wider text-gray-500 font-semibold mt-1">Top Streak</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-white">100%</p>
                        <p class="text-[11px] uppercase tracking-wider text-gray-500 font-semibold mt-1">Free to Play</p>
                    </div>
                </div>

            </main>

            <footer class="pb-6 pt-8 text-center text-xs text-gray-600 border-t border-zinc-900 w-full max-w-6xl mx-auto">
                <p>&copy; {{ date('Y') }} Word Battle Arena. All rights reserved. Made for word-smiths.</p>
            </footer>

        </div>
        </body>
</html>