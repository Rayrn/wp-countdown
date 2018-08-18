<?php

/**
 * Plugin Name: WP Countdown
 * Description: Wordpress countdown element
 * Version: 1.0.7
 * Author: Jack Hansard, Adrian Lewis
 * License: GPL v2
 */
if (!defined('ABSPATH')) {
    return;
}

define('WP_COUNTDOWN_DIR', \plugin_dir_path(__FILE__));
define('WP_COUNTDOWN_FOLDER', basename(__DIR__, 1));
define('WP_COUNTDOWN_PLUGIN_ID', 'wp-countdown');

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

$plugin = new Rayrn\WP\Countdown\CountdownPlugin();
$plugin->run();
