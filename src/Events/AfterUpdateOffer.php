<?php

namespace Jurager\Exchange\Events;

use Jurager\Exchange\Interfaces\OfferInterface;
use Jurager\Commerce\Model\Offer;

class AfterUpdateOffer extends AbstractEventInterface
{
    public const NAME = 'after.update.offer';

    /**
     * @var OfferInterface
     */
    public OfferInterface $model;

    /**
     * @var Offer
     */
    public Offer $offer;

    /**
     * AfterUpdateOffer constructor.
     *
     * @param OfferInterface $model
     * @param Offer $offer
     */
    public function __construct(OfferInterface $model, Offer $offer)
    {
        $this->model = $model;
        $this->offer = $offer;
    }
}
