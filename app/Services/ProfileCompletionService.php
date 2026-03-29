<?php

namespace App\Services;

use App\Models\Client;

class ProfileCompletionService
{
    public static function calculate(Client $client)
    {
        $score = 0;

        if (!empty($client->data['personals'])) {
            $score += 30;
        }

        if (!empty($client->user?->avatar)) {
            $score += 10;
        }

        if (!empty($client->data['educations'])) {
            $score += 30;
        }

        if ($client->documents()->exists()) {
            $score += 30;
        }

        // if ($client->documents()->count() > 0) {
        //     $score += 30;
        // }

        $client->update([
            'profile_completion' => $score
        ]);
    }
}