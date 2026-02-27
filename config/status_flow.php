<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Status Flow
    |--------------------------------------------------------------------------
    | Define allowed next statuses for each current status.
    | This prevents backward or invalid transitions.
    */

    'application' => [

        'pending' => [
            'processing',
        ],

        'processing' => [
            'approved',
            'declined',
        ],

        'approved' => [
            // No further changes allowed
        ],

        'declined' => [
            // Locked state
        ],

    ],

];