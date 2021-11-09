<?php

namespace CodingLiki\EventDispatcher\Exceptions;

use JetBrains\PhpStorm\Pure;

class NotKnownEventDispatcherException extends \Exception
{
    #[Pure] public function __construct(string $name)
    {
        parent::__construct('there is no event dispatcher with name '.$name);
    }
}