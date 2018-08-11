<?php

namespace Rayrn\WP\Countdown\Shortcode

class Countdown
{
    /**
     * @var string Countdown end date
     */
    private $date;

    /**
     * @var int Countdown end hour
     */
    private $hour;

    /**
     * @var int Countdown end min
     */
    private $min;

    /**
     * Create a new instance of this object
     *
     * @param string $date
     * @param int $hour
     * @param int $min
     */
    public function __construct(string $date, int $hour, int $min)
    {
        $this->date = date('Y-m-d', strtotime($date));
        $this->hour = $this->between($hour, 0, 24);
        $this->min = $this->between($min, 0, 60);
    }

    /**
     * PHP Magic Method (called when you try to echo an object)
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            '<div class="wp-countdown" data-attribute-date="%s" />',
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
        return "{$this->date} {$this->hour}:$this->min";
    }
}
