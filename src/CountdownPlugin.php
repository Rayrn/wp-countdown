<?php

namespace Rayrn\WP\Countdown;

use League\Container\Container;
use League\Container\ReflectionContainer;

class CountdownPlugin extends Container
{
    public function __construct()
    {
        parent::__construct();

        $this->delegate(new ReflectionContainer());
        $this->boot();
    }

    public function run()
    {

    }

    protected function boot()
    {
        $this->add(Shortcode\Countdown::class, function ($date, $hour = 0, $min = 0) {
            return new Shortcode\Countdown($date, $hour, $min);
        });
    }
}
