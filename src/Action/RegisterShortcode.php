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
            $pendingDueText = $options['pending-due-text'] ?? '';
            $pendingExpiryText = $options['pending-expiry-text'] ?? '';
            $expiredText = $options['expired-text'] ?? '';
            $duedate = $options['due-date'] ?? '';
            $duehour = $options['due-hour'] ?? 0;
            $duemin = $options['due-min'] ?? 0;
            $expirydate = $options['expiry-date'] ?? '';
            $expiryhour = $options['expiry-hour'] ?? 0;
            $expirymin = $options['expiry-min'] ?? 0;

            return $this->countdownfactory->create(
                $pendingDueText, $pendingExpiryText, $expiredText,
                $duedate, $duehour, $duemin,
                $expirydate, $expiryhour, $expirymin);
        });
    }
}
