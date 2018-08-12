<?php

namespace Rayrn\WP\Countdown\Action;

use Rayrn\WP\Countdown\Shortcode\CountdownFactory;

class RegisterShortcode extends Action
{
    public function __construct(CountdownFactory $countdownfactory)
    {
        $this->countdownfactory = $countdownfactory;
    }

    /**
     * Add the shortcode
     *
     * @param array ...$args
     */
    public function action(...$args)
    {
        add_shortcode('wp-countdown', function ($options) {
            $date = $options['date'] ?? '';
            $hour = $options['hour'] ?? 0;
            $min = $options['min'] ?? 0;

            return $this->countdownfactory->create($date, $hour, $min);
        });
    }
}
