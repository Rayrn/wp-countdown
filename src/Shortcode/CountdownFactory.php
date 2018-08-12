<?php

namespace Rayrn\WP\Countdown\Shortcode;

class CountdownFactory
{
    public function create($date, $hour, $min): Countdown
    {
        return new Countdown($date, $hour, $min);
    }
}
