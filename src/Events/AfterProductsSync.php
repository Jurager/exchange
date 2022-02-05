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
    public ?string $merchant_id;

    /**
     * AfterProductsSync constructor.
     *
     * @param array $ids
     * @param string|null $merchant_id
     */
    public function __construct(array $ids = [], ?string $merchant_id = null)
    {
        $this->ids = $ids;
        $this->merchant_id = $merchant_id;
    }
}
