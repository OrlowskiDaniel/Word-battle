<?php

namespace App\Http\Controllers;

use App\Models\GameHistory;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $history = GameHistory::where('user_id', Auth::id())
            ->with(['game.word', 'opponent'])
            ->orderBy('played_at', 'desc')
            ->get();

        return view('history.index', compact('history'));
    }
}