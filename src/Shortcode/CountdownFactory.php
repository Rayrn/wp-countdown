<?php

namespace Rayrn\WP\Countdown\Shortcode;

class CountdownFactory
{
    public function create(
        string $pendingDueText,
        string $pendingExpiryText,
        string $expiredText,
        string $dueDate,
        int $dueHour,
        int $dueMin,
        string $expiryDate,
        int $expiryHour,
        int $expiryMin): Countdown
    {
        return new Countdown(
            $pendingDueText,
            $pendingExpiryText,
            $expiredText,
            $dueDate,
            $dueHour,
            $dueMin,
            $expiryDate,
            $expiryHour,
            $expiryMin);
    }
}
