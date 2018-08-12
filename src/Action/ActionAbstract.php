<?php

namespace Rayrn\WP\Countdown\Action;

abstract class ActionAbstract
{
    /**
     * @var int Priority
     */
    protected $priority = 10;

    /**
     * @var int $arguments
     */
    protected $arguments = 1;

    /**
     * WP Action
     *
     * @param ... $args
     * @return mixed
     */
    abstract function action(... $args);

    /**
     * Get the action priority
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Get the action argument count
     *
     * @return int
     */
    public function getArguments(): int
    {
        return $this->arguments;
    }
}
