<?php

return [

    /*
     * Maximum number of guesses allowed per player per game.
     * If both players reach this without a correct guess → draw.
     */
    'max_guesses_per_player' => 5,

    /*
     * How many seconds a player has to submit their guess.
     * This is stored in Redis when a turn starts.
     * Set to null to disable time limits.
     */
    'turn_timeout_seconds' => 60,

    /*
     * Redis key prefixes — keeps game keys separate from other cached data.
     */
    'redis_keys' => [
        'current_turn' => 'game:turn:',      // game:turn:{game_id} → user_id
        'turn_started' => 'game:turnstart:',  // game:turnstart:{game_id} → timestamp
    ],

];