<?php

/**
 * Plugin Name: WP Countdown
 * Description: Wordpress countdown element
 * Version: 1
 * Author: Jack Hansard
 * License: GPL v2
 */
if (!defined('ABSPATH')) {
    return;
}

define('WP_COUNTDOWN_DIR', \plugin_dir_path(__FILE__));
define('WP_COUNTDOWN_PLUGIN_ID', 'im-riddle');

// If you're not using Composer for your whole project, but only the plugin,
// you can include the following to autoload the required classes.
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

$plugin = new Rayrn\WP\Countdown\CountdownPlugin();
$plugin->run();
