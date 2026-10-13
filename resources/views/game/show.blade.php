<x-app-layout>
    <x-slot:header>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Game Lobby</h2>
    </x-slot:header>
    
    {{-- GAME HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-xs font-semibold tracking-widest text-gray-400 dark:text-gray-500 uppercase mb-1">
                Game #{{ $game->game_id }}
            </p>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Word Battle</h1>
        </div>

        {{-- Status badge --}}
        <span class="text-xs font-medium px-3 py-1 rounded-full
            {{ $game->status === 'in_progress'   ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400' : '' }}
            {{ $game->status === 'waiting'  ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-400' : '' }}
            {{ $game->status === 'completed' ? 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300' : '' }}">
            {{ ucfirst($game->status) }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- left: word info + guess form --}}
        <div class="md:col-span-2 space-y-4">

            {{-- Word hint & question (always visible) --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-5 bg-white dark:bg-gray-800">
                <p class="text-xl font-semibold text-gray-400 mb-3">Clues</p>

                <div class="mb-3">
                    <span class="text-xs text-gray-400 dark:text-gray-500">Category</span>
                    <p class="font-medium text-gray-900 dark:text-white mt-0.5">{{ $game->word->category }}</p>
                </div>

                <div class="mb-3">
                    <span class="text-xs text-gray-400 dark:text-gray-500">Hint</span>
                    <p class="font-medium text-gray-900 dark:text-white mt-0.5">{{ $game->word->hint }}</p>
                </div>

                <div>
                    <span class="text-xs text-gray-400 dark:text-gray-500">Question</span>
                    <p class="font-medium text-gray-900 dark:text-white mt-0.5">{{ $game->word->question }}</p>
                </div>
            </div>

            {{-- Word length hint (show dashes like _) --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-5 bg-white dark:bg-gray-800">
                <p class="text-xl font-semibold text-gray-400 mb-3">Word length</p>
                <div class="flex gap-2">
                    @for ($i = 0; $i < strlen($game->word->word); $i++)
                        <span class="w-7 h-7 border-b-2 border-gray-400 dark:border-gray-500
                                     flex items-end justify-center text-xs text-gray-300">
                            _
                        </span>
                    @endfor
                </div>
                <p class="text-xs text-gray-400 mt-2">{{ strlen($game->word->word) }} letters</p>
            </div>

            {{-- GUESS FORM --}}
            @if ($game->status === 'in_progress')
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-5 bg-white dark:bg-gray-800">
                    <p class="text-xl font-semibold text-gray-400 mb-3">
                        Your guess
                    </p>
                    <form method="POST" action="{{ route('games.guess', $game) }}">
                        @csrf
                        
                        <div class="flex gap-3">
                            <input
                                type="text"
                                name="word_guess"
                                placeholder="Type your guess…"
                                autocomplete="off"
                                autofocus
                                value="{{ old('word_guess') }}"
                                class="flex-1 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-md px-3 py-2 text-sm dark:text-white dark:placeholder-gray-400"
                                {{-- Disable input if it is not this player turn --}}
                                @if(!optional($game->players->where('user_id', Auth::id())->first())->pivot?->is_turn)
                                    disabled
                                @endif
                            />
                            <button type="submit"
                                    class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-700 dark:hover:bg-gray-200">
                                Guess
                            </button>
                        </div>
                        {{-- Validation Error Display --}}
                        @error('word_guess')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            @endif

            {{-- COMPLETED STATE --}}
            @if ($game->status === 'completed')
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-5 bg-white dark:bg-gray-800">

                @php
                    $winner = $game->guesses->where('is_correct', true)->first()?->user;
                    $isWinner = $winner?->user_id === Auth::id();
                @endphp

                <p class="text-xl font-semibold mb-1 {{ $isWinner ? 'text-green-500' : 'text-red-400' }}">
                    {{ $isWinner ? 'You won!' : 'You lost.' }}
                </p>

                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">
                    The word was: <span class="font-bold text-gray-900 dark:text-white">{{ $game->word->word }}</span>
                </p>

                @if ($winner)
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Winner: <span class="font-medium text-gray-900 dark:text-white">{{ $winner->username }}</span>
                    </p>
                @endif

                <a href="{{ route('dashboard') }}"
                class="inline-block mt-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-700 dark:hover:bg-gray-200">
                    Back to lobby
                </a>
            </div>
            @endif

            {{-- WAITING: show shareable link --}}
            @if ($game->status === 'waiting')
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-5 bg-white dark:bg-gray-800">
                    <p class="text-xs font-semibold tracking-widest text-gray-400 uppercase mb-2">
                        Waiting for opponent
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">
                        Share this link with a friend, or they can join from the lobby.
                    </p>
                    <div class="flex gap-2">
                        <input
                            id="share-link"
                            type="text"
                            readonly
                            value="{{ route('games.show', $game) }}"
                            class="flex-1 border border-gray-300 dark:border-gray-600
                                   bg-gray-50 dark:bg-gray-700 rounded-md px-3 py-2 text-sm
                                   text-gray-600 dark:text-gray-300"
                        />
                    </div>
                </div>
            @endif

        </div>{{-- end left col --}}

        {{-- right: players + guess history --}}
        <div class="space-y-4">

            {{-- Players --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-white dark:bg-gray-800">
                <p class="text-xs font-semibold tracking-widest text-gray-400 uppercase mb-3">Players</p>
                @foreach ($game->players as $player)
                    <div class="flex items-center justify-between py-1.5">
                        <span class="text-sm text-gray-900 dark:text-white">
                            {{-- Called username directly on the User model ($player) --}}
                            {{ $player->username }}
                            @if ($player->id === Auth::id())
                                <span class="text-xs text-gray-400">(you)</span>
                            @endif
                        </span>
                        {{-- Highlight whose turn it is using the pivot table property --}}
                        @if ($game->status === 'in_progress' && $player->pivot->is_turn)
                            <span class="text-xs bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-400 px-2 py-0.5 rounded-full">
                                Turn
                            </span>
                        @endif
                    </div>
                @endforeach

                @if ($game->players->count() < 2)
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-2 italic">Waiting for 2nd player…</p>
                @endif
            </div>

            {{-- Guess history --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-white dark:bg-gray-800">
                <p class="text-xs font-semibold tracking-widest text-gray-400 uppercase mb-3">
                    Guesses ({{ $game->guesses->count() }})
                </p>

                @forelse ($game->guesses->sortByDesc('created_at') as $guess)
                    <div class="py-1.5 border-b border-gray-100 dark:border-gray-700 last:border-0">
                        <span class="text-xs text-gray-400 dark:text-gray-500">
                            {{ $guess->user->username }}
                        </span>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $guess->word_guess }}
                        </p>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 dark:text-gray-500 italic">No guesses yet.</p>
                @endforelse
            </div>

        </div>{{-- end right col --}}
    </div>
</x-app-layout>