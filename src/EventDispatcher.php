<?php

namespace CodingLiki\EventDispatcher;


use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;

class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @param ListenerProviderInterface[] $listenerProviders
     */
    public function __construct(private array $listenerProviders)
    {
    }

    public function dispatch(\object $event): \object
    {
        foreach ($this->listenerProviders as $listenerProvider) {
            foreach ($listenerProvider->getListenersForEvent($event) as $listener) {
                if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
                    return $event;
                }
                call_user_func($listener, $event);
            }
        }

        return $event;
    }
}