<?php

namespace CodingLiki\EventDispatcher\ListenerProviders;


use Psr\EventDispatcher\ListenerProviderInterface;

class ArrayListenerProvider implements ListenerProviderInterface
{
    /**
     * @param array<string, array<callable>> $listeners
     */
    public function __construct(private array $listeners = [])
    {
    }

    public function addListener(string $eventClass, callable $listener): static
    {
        isset($this->listeners[$eventClass]) ?: $this->listeners[$eventClass] = [];
        $this->listeners[$eventClass][] = $listener;

        return $this;
    }

    public function getListenersForEvent(object $event): iterable
    {
        return $this->listeners[$event::class] ?? [];
    }
}