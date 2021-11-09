<?php

namespace CodingLiki\EventDispatcher;

use CodingLiki\EventDispatcher\Exceptions\NotKnownEventDispatcherException;
use Psr\EventDispatcher\EventDispatcherInterface;

class EventDispatcherContainer
{
    public const MAIN_DISPATCHER_NAME = 'main';
    /**
     * @var array<string, EventDispatcherInterface>
     */
    private static array $dispatchers = [];

    /**
     * @throws NotKnownEventDispatcherException
     */
    public static function get(string $name = self::MAIN_DISPATCHER_NAME): EventDispatcherInterface
    {
        isset(self::$dispatchers[$name]) ?: throw new NotKnownEventDispatcherException($name);

        return self::$dispatchers[$name];
    }

    public static function add(string $name, EventDispatcherInterface $eventDispatcher): void
    {
        self::$dispatchers[$name] = $eventDispatcher;
    }
}