<?php

namespace Jurager\Exchange;

use Jurager\Exchange\Interfaces\EventDispatcherInterface;
use Jurager\Exchange\Interfaces\EventInterface;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * Class EventDispatcher.
 */
class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var Dispatcher
     */
    protected Dispatcher $eventDispatcher;

    /**
     * EventDispatcher constructor.
     *
     * @param Dispatcher $eventDispatcher
     */
    public function __construct(Dispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param EventInterface $event
     */
    public function dispatch(EventInterface $event): void
    {
        $this->eventDispatcher->dispatch($event);
    }
}
