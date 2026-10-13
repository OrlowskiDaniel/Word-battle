<x-app-layout>
    <x-slot:header>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Game History</h2>
    </x-slot:header>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">

            {{-- Stats row --}}
            <div class="grid grid-cols-3 gap-4 mb-8">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total games played</p>
            </div>
            {{-- Games table --}}
            <div class="max-w-2xl mx-auto space-y-3">
                @forelse ($history as $entry)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-white dark:bg-gray-800 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                vs <span class="font-medium text-gray-900 dark:text-white">{{ $entry->opponent?->username ?? 'Unknown' }}</span>
                                &mdash; <span class="text-xs text-gray-400">{{ $entry->played_at->diffForHumans() }}</span>
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">Word: {{ $entry->game->word->word }}</p>
                        </div>
                        <span class="text-xs font-medium px-3 py-1 rounded-full
                            {{ $entry->result === 'win' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400' }}">
                            {{ ucfirst($entry->result) }}
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 italic">No games played yet.</p>
                @endforelse
            </div>
                

        </div>
    </div>
</x-app-layout>