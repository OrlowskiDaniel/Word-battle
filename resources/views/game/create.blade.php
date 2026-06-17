<x-app-layout>
    <x-slot:header>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">New Game</h2>
    </x-slot:header>

    <div class="py-8">
        <div class="max-w-md mx-auto px-4 sm:px-6">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">

                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    A random word will be chosen. You can invite a specific player or leave it open for anyone to join.
                </p>

                <form method="POST" action="{{ route('games.store') }}">
                    @csrf

                    <div class="mb-5">
                        <x-input-label for="opponent_username" value="Invite a player (optional)" />
                        <x-text-input
                            id="opponent_username"
                            name="opponent_username"
                            type="text"
                            class="mt-1 block w-full bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100"
                            placeholder="Enter their username"
                            value="{{ old('opponent_username') }}"
                        />
                        <x-input-error :messages="$errors->get('opponent_username')" class="mt-1" />
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1.5">Leave empty to create an open game anyone can join.</p>
                    </div>

                    <div class="mb-6">
                        <x-input-label for="category" value="Word category (optional)" />
                        <select id="category" name="category"
                            class="mt-1 block w-full bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-md shadow-sm text-sm focus:ring-0 focus:border-gray-400">
                            <option value="" class="bg-white dark:bg-gray-900">— Random —</option>
                            <option value="animals"  {{ old('category') === 'animals'  ? 'selected' : '' }}>Animals</option>
                            <option value="nature"   {{ old('category') === 'nature'   ? 'selected' : '' }}>Nature</option>
                            <option value="objects"  {{ old('category') === 'objects'  ? 'selected' : '' }}>Objects</option>
                            <option value="places"   {{ old('category') === 'places'   ? 'selected' : '' }}>Places</option>
                            <option value="music"    {{ old('category') === 'music'    ? 'selected' : '' }}>Music</option>
                            <option value="food"     {{ old('category') === 'food'     ? 'selected' : '' }}>Food</option>
                            <option value="sport"    {{ old('category') === 'sport'    ? 'selected' : '' }}>Sport</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-primary-button>Create game</x-primary-button>
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>