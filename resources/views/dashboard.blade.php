<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Lobby</h1>
                <a href="{{ route('games.create') }}"
                   class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-700 dark:hover:bg-gray-200">
                    + New game
                </a>
            </div>

            {{-- OPEN GAMES TO JOIN --}}
            <section class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="text-xs font-semibold tracking-widest text-gray-400 dark:text-gray-500 uppercase mb-4">
                    Open games (join one)
                </h2>

                @forelse ($waitingGames as $game)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 mb-3 flex items-center justify-between bg-gray-50 dark:bg-gray-900">
                        <p class="text-sm text-gray-900 dark:text-white font-medium">
                            {{ $game->players->first()?->name ?? $game->players->first()?->username ?? 'Someone' }}'s game
                        </p>

                        <form method="POST" action="{{ route('games.join', $game) }}">
                            @csrf
                            <button type="submit"
                                    class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-1.5 rounded-md font-medium shadow-sm transition">
                                Join
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">No open games right now.</p>
                @endforelse
            </section>

        </div>
    </div>
</x-app-layout>