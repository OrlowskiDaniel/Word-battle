<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Word Battle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased">

    {{-- Nav --}}
    <header class="border-b border-gray-200 dark:border-gray-800 dark:bg-gray-800">
        <div class="max-w-4xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('word-battle-logo2.png') }}" alt="Word Battle Logo" class="h-16 w-auto" />
            </a>
            <nav class="flex items-center gap-4 text-sm">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Log in</a>
                    <a href="{{ route('register') }}" class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-4 py-1.5 rounded-md text-sm font-medium hover:bg-gray-700 dark:hover:bg-gray-200">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- Hero --}}
    <main class="max-w-4xl mx-auto px-6">

        <section class="py-24 max-w-xl">
            <p class="text-xs font-semibold tracking-widest text-gray-400 dark:text-gray-500 uppercase mb-4">Turn-based word game</p>
            <h1 class="text-4xl font-bold leading-tight mb-4 text-gray-900 dark:text-white">
                Can you guess the word before your opponent?
            </h1>
            <p class="text-gray-500 dark:text-gray-400 text-lg mb-8 leading-relaxed">
                Take turns guessing the hidden word. First to guess correctly wins. Challenge a friend or get matched with a random opponent.
            </p>
            <div class="flex gap-3">
                @auth
                    <a href="{{ route('games.create') }}" class="bg-gray-700 dark:bg-white text-white dark:text-gray-900 px-5 py-2.5 rounded-md font-medium hover:bg-gray-700 dark:hover:bg-gray-200">Start a game</a>
                    <a href="{{ route('dashboard') }}" class="border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 px-5 py-2.5 rounded-md font-medium hover:bg-gray-50 dark:hover:bg-gray-800">Go to lobby</a>
                @else
                    <a href="{{ route('register') }}" class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-5 py-2.5 rounded-md font-medium hover:bg-gray-700 dark:hover:bg-gray-200">Play for free</a>
                    <a href="{{ route('login') }}" class="border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 px-5 py-2.5 rounded-md font-medium hover:bg-gray-50 dark:hover:bg-gray-800">Log in</a>
                @endauth
            </div>
        </section>

        <hr class="border-gray-200 dark:border-gray-800">

        {{-- How it works --}}
        <section class="py-16">
            <h2 class="text-xs font-semibold tracking-widest text-gray-400 dark:text-gray-500 uppercase mb-10">How it works</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-10">
                <div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white mb-2">01</div>
                    <h3 class="font-semibold mb-1 text-gray-900 dark:text-gray-200">Start a game</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Invite a friend or join a random match. A word is secretly chosen.</p>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white mb-2">02</div>
                    <h3 class="font-semibold mb-1 text-gray-900 dark:text-gray-200">Take turns guessing</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Players alternate guessing the full word each turn. You get a hint and a question.</p>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white mb-2">03</div>
                    <h3 class="font-semibold mb-1 text-gray-900 dark:text-gray-200">First to win</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Guess the word correctly before your opponent and claim the win.</p>
                </div>
            </div>
        </section>

        <hr class="border-gray-200 dark:border-gray-800">

        {{-- Footer --}}
        <footer class="py-8 flex items-center justify-between text-xs text-gray-400 dark:text-gray-500">
            <span>Word Battle &copy; {{ date('Y') }}</span>
        </footer>

    </main>
</body>
</html>