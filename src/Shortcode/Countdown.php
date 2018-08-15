<?php

namespace Rayrn\WP\Countdown\Shortcode;

class Countdown
{
    /**
     * @var string Countdown pending due message
     */
    private $pendingDueText;

    /**
     * @var string Countdown pending expiry message
     */
    private $pendingExpiryText;

    /**
     * @var string Countdown expired message
     */
    private $expiredText;

    /**
     * @var string Countdown end date
     */
    private $dueDate;

    /**
     * @var int Countdown end hour
     */
    private $dueHour;

    /**
     * @var int Countdown end min
     */
    private $dueMin;

    /**
     * @var string Countdown end date
     */
    private $expiryDate;

    /**
     * @var int Countdown end hour
     */
    private $expiryHour;

    /**
     * @var int Countdown end min
     */
    private $expiryMin;

    /**
     * Create a new instance of this object
     *
     * @param string $pendingDueText
     * @param string $pendingExpiryText
     * @param string $expiredText
     * @param string $dueDate
     * @param int $dueHour
     * @param int $dueMin
     * @param string $expiryDate
     * @param int $expiryHour
     * @param int $expiryMin
     */
    public function __construct(
        string $pendingDueText,
        string $pendingExpiryText,
        string $expiredText,
        string $dueDate,
        int $dueHour,
        int $dueMin,
        string $expiryDate,
        int $expiryHour,
        int $expiryMin)
    {
        $this->pendingDueText = $pendingDueText;
        $this->pendingExpiryText = $pendingExpiryText;
        $this->expiredText = $expiredText;
        $this->dueDate = date('Y-m-d', strtotime($dueDate));
        $this->dueHour = $this->between($dueHour, 0, 23);
        $this->dueMin = $this->between($dueMin, 0, 59);
        $this->expiryDate = date('Y-m-d', strtotime($expiryDate));
        $this->expiryHour = $this->between($expiryHour, 0, 23);
        $this->expiryMin = $this->between($expiryMin, 0, 59);
    }

    /**
     * PHP Magic Method (called when you try to echo an object)
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            '<div class="wp-countdown" data-pending-due-text="%s" data-pending-expiry-text="%s" data-expired-text="%s" data-due-date="%s" data-expiry-date="%s">' +
            '<span class="wp-countdown-prefix-label"></span>' +
            '<div class="wp-countdown-countdown">' +
            '<div class="wp-countdown-days">' +
            '<span class="odometer countdown-time-days"></span>' +
            '<span class="countdown-time-days-label">d</span>' +
            '</div>' +
            '<div class="wp-countdown-hours">' +
            '<span class="odometer countdown-time-hours"></span>' +
            '<span class="countdown-time-hours-label">h</span>' +
            '</div>' +
            '<div class="wp-countdown-minutes">' +
            '<span class="odometer countdown-time-minutes"></span>' +
            '<span class="countdown-time-minutes-label">m</span>' +
            '</div>' +
            '<div class="wp-countdown-seconds">' +
            '<span class="odometer countdown-time-seconds"></span>' +
            '<span class="countdown-time-seconds-label">s</span>' +
            '</div>' +
            '</div>' +
            '</div>',
            $this->pendingDueText,
            $this->pendingExpiryText,
            $this->expiredText,
            $this->getDueDate()
            $this->getExpiryDate()
        );
    }

    /**
     * Ensure a number is between two values
     *
     * @param int $number
     * @param int $min
     * @param int $max
     * @return int
     */
    private function between(int $number, int $min, int $max): int
    {
        if ($number < $min) {
            return $min;
        }

        if ($number > $max) {
            return $max;
        }

        return $number;
    }

    /**
     * Return the due date string
     *
     * @return string
     */
    private function getDueDate(): string
    {
        return "{$this->dueDate}T{$this->dueHour}:{$this->dueMin}";
    }

    /**
     * Return the expiry date string
     *
     * @return string
     */
    private function getExpiryDate(): string
    {
        return "{$this->expiryDate}T{$this->expiryHour}:{$this->expiryMin}";
    }
}
