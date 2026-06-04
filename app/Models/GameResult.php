<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameResult extends Model
{
    protected $primaryKey = 'result_id';

    protected $fillable = [
        'game_id',
        'winner_id',
        'result_type',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    // nullable = returns null when it is a draw
    public function winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'winner_id', 'user_id');
    }

    public function isDraw(): bool
    {
        return $this->result_type === 'draw';
    }
}