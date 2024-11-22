<?php

namespace App\Helpers;

use App\Models\Contribution;
use App\Models\Member;

class Helper
{
    public static function handleContribution($amount, $userId, $frequency = null)
    {
        $member = Member::inRandomOrder()->first();

        // Crée une nouvelle contribution
        Contribution::create([
            'member_id' => $member->id,
            'amount' => $amount,
            'user_id' => $userId,
            'description' => 'Contribution test',
            'payment' => $frequency,
        ]);

        return $member;
    }
}
