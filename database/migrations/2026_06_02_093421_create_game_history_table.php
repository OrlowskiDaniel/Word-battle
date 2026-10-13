<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_history', function (Blueprint $table) {
            $table->id('history_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete();
            $table->foreignId('game_id')->constrained('games', 'game_id')->cascadeOnDelete();
            $table->foreignId('opponent_id')->constrained('users', 'user_id')->cascadeOnDelete();
            // result from this specific user's perspective: 'win', 'loss', 'draw'
            $table->string('result', 10);
            $table->timestamp('played_at');
 
            // index so loading a user's history is fast
            $table->index(['user_id', 'played_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_history');
    }
};
