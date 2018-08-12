<?php

namespace Rayrn\WP\Countdown;

use League\Container\Container;
use League\Container\ReflectionContainer;

class CountdownPlugin extends Container
{
    /**
     * Create a new instance of this class
     */
    public function __construct()
    {
        parent::__construct();

        $this->delegate(new ReflectionContainer());
        $this->boot();
    }

    /**
     * Set up the plugin
     */
    public function run()
    {
        $this->addAction('init', $this->get(Action\RegisterScripts::class));
        $this->addAction('init', $this->get(Action\RegisterStyles::class));
        $this->addAction('init', $this->get(Action\RegisterShortcode::class));

        $this->addAction('register_shortcode_ui', $this->get(Action\RegisterModalInterface::class));
    }

    /**
     * Runs on plugin init
     */
    private function boot()
    {
        $this->add(Shortcode\Countdown::class, function ($date, $hour = 0, $min = 0) {
            return new Shortcode\Countdown($date, $hour, $min);
        });

        $this->add(Action\RegisterShortcode::class, function () {
            $registerShortcode = new Action\RegisterShortcode($this);
            $registerShortcode->setContainer($this);

            return $registerShortcode;
        });
    }

    /**
     * Add a wp action
     *
     * @param string $hook
     * @param Action\Action $action
     */
    private function addAction(string $hook, Action\Action $action)
    {
        add_action($hook, [$action, 'action'], $action->getPriority(), $action->getArguments());
    }
}
