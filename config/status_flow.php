<?php

return [

    /*
    |--------------------------------------------------------------------------
    |Status Flow
    |--------------------------------------------------------------------------
    | Define allowed next statuses for each current status.
    | This prevents backward or invalid transitions.
    */

    'form' => [

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

    'invoice' => [

        'pending' => [
            'processing',
        ],

        'processing' => [
            'pending',
            'approved',
            'cancelled',
        ],

        'approved' => [
            // No further changes allowed
        ],

        'cancelled' => [
            // Locked state
        ],

    ],

    'document' => [

        'pending' => [
            'uploaded',
        ],

        'uploaded' => [
            'verified',
            'declined',
        ],

        'verified' => [
            // No further changes allowed
        ],

        'declined' => [
            // Locked state
        ],

    ],

    'stage' => [
        'start' => [
            'lead',
        ],
        'lead' => [
            'invoice',
        ],
        'invoice' => [
            'documentation',
        ],
        'documentation' => [
            'application',
        ],
        'application' => [
            'visa',
        ],
        'visa' => [
            'flight',
        ],
        'flight' => [
            'mission',
        ],
        'mission' => [
            // No further changes allowed
        ],
    ],

];