<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    
    // relationships
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_players', 'user_id', 'game_id')
                    ->withPivot('is_turn');
    }

    /**
     * all guesses this user has made
     */
    public function guesses(): HasMany
    {
        return $this->hasMany(Guess::class, 'user_id');
    }

    /**
     * games this user has won
     */
    public function wins(): HasMany
    {
        return $this->hasMany(GameResult::class, 'winner_id');
    }

    /**
     * this user game history
     */
    public function gameHistory(): HasMany
    {
        return $this->hasMany(GameHistory::class, 'user_id')
                    ->orderBy('played_at', 'desc');
    }
}