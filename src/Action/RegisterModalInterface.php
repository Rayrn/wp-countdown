<?php

namespace Rayrn\WP\Countdown\Action;

class RegisterModalInterface extends Action
{
    /**
     * Register the UI for editing the shortcode
     *
     * @param array ...$args
     */
    public function action(...$args)
    {
        shortcode_ui_register_for_shortcode(
            WP_COUNTDOWN_PLUGIN_ID,
            [
                'label' => __('WP Countdown', WP_COUNTDOWN_PLUGIN_ID),
                'listItemImage' => 'dashicons-clock',
                'post_type' => get_post_types([
                    'public' => true,
                ]),
                'attrs' => [
                    [
                        'label' => __('Date', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'date',
                        'type'  => 'date',
                    ],
                    [
                        'label' => __('Hour', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'hour',
                        'type'  => 'number',
                    ],
                    [
                        'label' => __('Min', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'min',
                        'type'  => 'number',
                    ]
                ],
            ]
        );
    }
}
