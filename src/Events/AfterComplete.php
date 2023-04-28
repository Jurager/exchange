<?php

namespace Jurager\Exchange\Events;

class AfterComplete extends AbstractEventInterface
{
    public const NAME = 'after.complete';

    public $source_id;

    /**
     * AfterComplete constructor.
     *
     * @param string|null $source_id
     */
    public function __construct(string $source_id= null)
    {
        $this->source_id = $source_id;
    }

}