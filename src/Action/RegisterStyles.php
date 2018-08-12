<?php

namespace Rayrn\WP\Countdown\Action;

class RegisterStyles extends Action
{
    /**
     * Register the css
     *
     * @param array ...$args
     */
    public function action(...$args)
    {
        wp_enqueue_style(
            WP_COUNTDOWN_PLUGIN_ID . '-css',
            plugins_url() . WP_COUNTDOWN_DIR . '/assets/css/' . WP_COUNTDOWN_PLUGIN_ID . '.css'
        );
    }
}
