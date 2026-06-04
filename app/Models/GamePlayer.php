<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GamePlayer extends Model
{
    // no timestamps join events don't need them
    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'user_id',
        'is_turn',
    ];

    protected $casts = [
        'is_turn' => 'boolean',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}