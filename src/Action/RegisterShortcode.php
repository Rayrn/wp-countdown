<?php

namespace Rayrn\WP\Countdown\Action;

use League\Container\ContainerAwareTrait;
use League\Container\ContainerAwareInterface;
use Rayrn\WP\Countdown\Shortcode\Countdown;

class RegisterShortcode extends Action implements ContainerAwareInterface
{
    use ContainerAwareTrait;

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

            return $this->getContainer()->get(Countdown::class, [$date, $hour, $min]);
        });
    }
}
