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
        Schema::create('game_results', function (Blueprint $table) {
            $table->id('result_id');
            $table->foreignId('game_id')->constrained('games', 'game_id')->cascadeOnDelete();
            $table->foreignId('winner_id')->nullable()->constrained('users', 'user_id')->nullOnDelete();
            // result type: win, lose or draw
            $table->string('result_type', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_results');
    }
};
