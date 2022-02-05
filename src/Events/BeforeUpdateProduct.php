<?php

namespace Jurager\Exchange\Events;

use Jurager\Exchange\Interfaces\ProductInterface;

class BeforeUpdateProduct extends AbstractEventInterface
{
    public const NAME = 'before.update.product';

    /**
     * @var ProductInterface
     */
    public ProductInterface $product;

    /**
     * BeforeUpdateProduct constructor.
     *
     * @param ProductInterface $product
     */
    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }
}
