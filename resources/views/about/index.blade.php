<x-app-layout>
    <x-slot:header>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            About Word Battle
        </h2>
    </x-slot:header>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 shadow-sm">
                
                {{-- Introduction Section --}}
                <div class="max-w-2xl mb-12">
                    <p class="text-xs font-semibold tracking-widest text-gray-400 uppercase mb-3">The Concept</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        A mind match built on strategy, words, and timing.
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-base leading-relaxed">
                        Word Battle was designed to test vocabulary and deduction under pressure. Unlike linear word puzzles, every match pits you against another thinking player in real time. Can you piece together the clues faster than they can outsmart you?
                    </p>
                </div>

                <hr class="border-gray-100 dark:border-gray-700 my-8">

                {{-- Game Rules Breakdown --}}
                <div class="mb-10">
                    <p class="text-xs font-semibold tracking-widest text-gray-400 uppercase mb-6">Game Rules</p>
                    <div class="space-y-6 text-gray-600 dark:text-gray-400 text-sm">
                        <div class="flex items-start gap-4">
                            <span class="flex items-center justify-center bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white font-bold h-6 w-6 rounded-full shrink-0">1</span>
                            <p class="mt-0.5"><strong class="text-gray-900 dark:text-white">Strict Rotation:</strong> You cannot submit two guesses in a row. The system enforces strict turn pacing so your opponent always has room to retaliate.</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="flex items-center justify-center bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white font-bold h-6 w-6 rounded-full shrink-0">2</span>
                            <p class="mt-0.5"><strong class="text-gray-900 dark:text-white">Category Filters:</strong> Custom matches allow creators to lock down explicit vocab lists (like Animals or Sports), while open matches leverage the entire global dictionary.</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="flex items-center justify-center bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white font-bold h-6 w-6 rounded-full shrink-0">3</span>
                            <p class="mt-0.5"><strong class="text-gray-900 dark:text-white">The History Record:</strong> Complete game tallies, total turns played, and victory margins are saved forever in your History tracker.</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <a href="{{ route('games.create') }}" class="bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 px-5 py-2 rounded-md text-sm font-medium hover:bg-gray-700 dark:hover:bg-gray-200 transition">
                        Start Match
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        Back to Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>