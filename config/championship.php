<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Formats
    |--------------------------------------------------------------------------
    |
    | List of formats to be used on competitions when creating a championship.
    |
    */

    'formats' => [

        // A double-elimination tournament is a type of elimination tournament
        // competition in which a participant ceases to be eligible to win
        // the tournament's championship upon having lost two games.
        'double_elimination' => 'Double Elimination',

        // A standard format when the user ceases to be eligible to win
        // the tournament having lost one time.
        'single_elimination' => 'Single Elimination',
    ],
];
