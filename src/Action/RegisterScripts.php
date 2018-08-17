<?php

namespace Rayrn\WP\Countdown\Action;

class RegisterScripts extends Action
{
    /**
     * Register the javascript
     *
     * @param array ...$args
     */
    public function action(...$args)
    {
        wp_enqueue_script(
            WP_COUNTDOWN_PLUGIN_ID . '-javascript',
            plugins_url() . '/' . WP_COUNTDOWN_FOLDER . '/dist/js/' . WP_COUNTDOWN_PLUGIN_ID . '.js',
            array(),
            '1.0',
            true
        );
    }
}
