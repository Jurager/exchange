<?php

namespace Jurager\Exchange\Events;

class AfterOffersSync extends AbstractEventInterface
{
    public const NAME = 'after.offers.sync';

    /**
     * @var array
     */
    public array $ids;

    /**
     * AfterOffersSync constructor.
     *
     * @param array $ids
     */
    public function __construct(array $ids = [])
    {
        $this->ids = $ids;
    }
}
