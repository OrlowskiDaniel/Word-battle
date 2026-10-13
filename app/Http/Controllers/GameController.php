<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\Word;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * SHOW THE LOBBY / DASHBOARD
     * Route: GET /dashboard
     */
    public function dashboard(): View
    {
        // get all games looking for an opponent
        $waitingGames = Game::where('status', 'waiting')->with('players')->get();

        return view('dashboard', compact('waitingGames'));
    }


    public function niek(): View
    {
        $allgames = Game::all();

        return view('niek', compact('allgames'));
    }
    /**
     * SHOW THE "CREATE GAME" PAGE
     * Route: GET /games/create
     */
    public function create(): View
    {
        return view('game.create');
    }

    /**
     * SUBMIT AND CREATE THE GAME
     * Route: POST /games
     */
    public function store(Request $request): RedirectResponse
    {
        // get the current user's ID
        $creatorId = Auth::id();

        // pick a random word
        $word = Word::inRandomOrder()->firstOrFail();

        // create the game record
        $game = Game::create([
            'word_id' => $word->word_id,
            'status'  => 'waiting',
        ]);

        // add the creator as the first player
        GamePlayer::create([
            'game_id' => $game->game_id,
            'user_id' => $creatorId,
            'is_turn' => true,
        ]);

        // redirect to the game room
        return redirect()->route('games.show', $game);
    }

    /**
     * SHOW THE LIVE GAME ROOM
     * Route: GET /games/{game}
     */
    public function show(Game $game): View
    {
        $game->load(['word', 'players', 'guesses.user']);

        return view('game.show', compact('game'));
    }

    /**
     * JOIN AN OPEN GAME
     * Route: POST /games/{game}/join
     */
    public function join(Game $game): RedirectResponse
    {
        $userId = Auth::id();

        // already in this game? Just go to it.
        if ($game->players()->where('game_players.user_id', $userId)->exists()) {
            return redirect()->route('games.show', $game);
        }

        // add second player, no turn yet
        GamePlayer::create([
            'game_id' => $game->game_id,
            'user_id' => $userId,
            'is_turn' => false,
        ]);

        // First player (creator) keeps is_turn = true, already set in store()
        // Just flip status to in_progress
        $game->update(['status' => 'in_progress']);

        return redirect()->route('games.show', $game);
    }



}