<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Game extends Model
{
    use HasFactory;

    protected $primaryKey = 'game_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'word_id',
        'status',
    ];

    // word for this game
    public function word(): BelongsTo
    {
        return $this->belongsTo(Word::class, 'word_id');
    }

    // two players in this game
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'game_players', 'game_id', 'user_id', 'game_id', 'user_id')
                    ->withPivot('is_turn')
                    ->withTimestamps();
    }

    // guesses 
    public function guesses(): HasMany
    {
        return $this->hasMany(Guess::class, 'game_id')->orderBy('created_at');
    }

    // result of this game
    public function result(): HasOne
    {
        return $this->hasOne(GameResult::class, 'game_id');
    }

    // helper: still active?
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    // helper: waiting for second player?
    public function isWaiting(): bool
    {
        return $this->status === 'waiting';
    }
}