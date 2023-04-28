<?php

namespace Jurager\Exchange\Events;

class AfterProductsSync extends AbstractEventInterface
{
    public const NAME = 'after.products.sync';

    /**
     * @var array
     */
    public array $ids;

    /**
     * @var ?string
     */
    public ?string $source_id;

    /**
     * AfterProductsSync constructor.
     *
     * @param array $ids
     * @param string|null $source_id
     */
    public function __construct(array $ids = [], ?string $source_id = null)
    {
        $this->ids = $ids;
        $this->source_id = $source_id;
    }
}
