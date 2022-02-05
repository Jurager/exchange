<?php

namespace Jurager\Exchange\Interfaces;

/**
 * Interface EventDispatcherInterface.
 */
interface EventDispatcherInterface
{
    /**
     * @param EventInterface $event
     */
    public function dispatch(EventInterface $event): void;
}
