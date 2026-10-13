<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Guess;
use App\Models\GameHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class GuessController extends Controller
{
    public function store(Request $request, Game $game): RedirectResponse
    {
        // validation
        $request->validate([
            'word_guess' => 'required|string|max:100',
        ]);

        $userId = Auth::id();
        $game->load(['players', 'word']);

        // security check to see if game is in progress
        if ($game->status !== 'in_progress') {
            return redirect()->back()->withErrors(['word_guess' => 'This game is not active.']);
        }

        // security check to check if user is part of the page
        $currentPlayer = $game->players->where('user_id', $userId)->first();
        if (!$currentPlayer) {
            abort(403, 'You are not a player in this game.');
        }

        // game check to know if it is user turn
        if (!$currentPlayer->pivot->is_turn) {
            return redirect()->back()->withErrors(['word_guess' => 'It is not your turn yet!']);
        }

        // clean the guess and answer
        $guessWord = strtolower(trim($request->input('word_guess')));
        $correctWord = strtolower(trim($game->word->word));
        $isCorrect = ($guessWord === $correctWord);

        // add guess into the DB
        Guess::create([
            'game_id'    => $game->game_id,
            'user_id'    => $userId,
            'word_guess' => $request->input('word_guess'),
            'is_correct' => $isCorrect,
        ]);

        if ($isCorrect) {
            // WIN CONDITION met: update game status to completed
            $game->update(['status' => 'completed']);
            
            /** 
            * populate game_results / game_history table
            * save history for both players
            */
            $opponent = $game->players->where('user_id', '!=', $userId)->first();

            GameHistory::create([
                'user_id'     => $userId,
                'game_id'     => $game->game_id,
                'opponent_id' => $opponent?->user_id,
                'result'      => 'win',
                'played_at'   => now(),
            ]);

            if ($opponent) {
                GameHistory::create([
                    'user_id'     => $opponent->user_id,
                    'game_id'     => $game->game_id,
                    'opponent_id' => $userId,
                    'result'      => 'loss',
                    'played_at'   => now(),
                ]);
            }


            return redirect()->route('games.show', $game)->with('status', 'You Win! You guessed the word!');
        }

        // INCORRECT GUESS: swap the turn flag to the other player
        $opponent = $game->players->where('user_id', '!=', $userId)->first();

        if ($opponent) {
            $game->players()->updateExistingPivot($userId, ['is_turn' => false]);
            $game->players()->updateExistingPivot($opponent->user_id, ['is_turn' => true]);
        }

        return redirect()->route('games.show', $game);
    }
}