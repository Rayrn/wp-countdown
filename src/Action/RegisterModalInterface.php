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
                        'label' => __('Pending Due Text', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'pending-due-text',
                        'type'  => 'text',
                    ],
                    [
                        'label' => __('Pending Expiry Text', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'pending-expiry-text',
                        'type'  => 'text',
                    ],
                    [
                        'label' => __('Expired Text', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'expired-text',
                        'type'  => 'text',
                    ],
                    [
                        'label' => __('Due Date', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'due-date',
                        'type'  => 'date',
                    ],
                    [
                        'label' => __('Due Hour', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'due-hour',
                        'type'  => 'number',
                    ],
                    [
                        'label' => __('Due Min', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'due-min',
                        'type'  => 'number',
                    ],
                    [
                        'label' => __('Expiry Date', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'expiry-date',
                        'type'  => 'date',
                    ],
                    [
                        'label' => __('Expiry Hour', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'expiry-hour',
                        'type'  => 'number',
                    ],
                    [
                        'label' => __('Expiry Min', WP_COUNTDOWN_PLUGIN_ID),
                        'attr'  => 'expiry-min',
                        'type'  => 'number',
                    ]
                ],
            ]
        );
    }
}
