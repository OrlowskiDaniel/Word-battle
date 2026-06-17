<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('game.index');
    }

    public function create()
    {
        
        return view('game.create');
    }

    public function store(Request $request)
    {
        // temporary: just redirect back to games list
        return redirect()->route('games.index');
    }
}