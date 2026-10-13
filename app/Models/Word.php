<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Word extends Model
{
    use HasFactory;

    protected $primaryKey = 'word_id';

    // words don't need created_at/updated_at
    public $timestamps = false;

    protected $fillable = [
        'word',
        'category',
        'question',
        'hint',
    ];

    // all games that used this word
    public function games(): HasMany
    {
        return $this->hasMany(Game::class, 'word_id');
    }
}