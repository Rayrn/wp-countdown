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
        $this->date = date('Y-m-d', strtotime($date));
        $this->hour = $this->between($hour, 0, 23);
        $this->min = $this->between($min, 0, 59);
    }

    /**
     * PHP Magic Method (called when you try to echo an object)
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            '<div class="wp-countdown" data-date="%s"/>',
            $this->getDate()
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
     * Return the date string
     *
     * @return string
     */
    private function getDate(): string
    {
        return "{$this->date}T{$this->hour}:{$this->min}";
    }
}
