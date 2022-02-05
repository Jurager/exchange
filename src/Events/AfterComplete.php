<?php

namespace Jurager\Exchange\Events;

class AfterComplete extends AbstractEventInterface
{
    public const NAME = 'after.complete';

    public $merchant_id;

    /**
     * AfterComplete constructor.
     *
     * @param string|null $merchant_id
     */
    public function __construct(string $merchant_id = null)
    {
        $this->merchant_id = $merchant_id;
    }

}