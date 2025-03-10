<?php

namespace Jurager\Exchange\Events;

/**
 * Class AbstractEventInterface.
 */
abstract class AbstractEventInterface implements \Jurager\Exchange\Interfaces\EventInterface
{
    public const NAME = self::class;

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }
}
