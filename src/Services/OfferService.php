<?php

namespace Jurager\Exchange\Services;

use Jurager\Exchange\Config;
use Jurager\Exchange\Events\AfterOffersSync;
use Jurager\Exchange\Events\AfterUpdateOffer;
use Jurager\Exchange\Events\BeforeOffersSync;
use Jurager\Exchange\Events\BeforeUpdateOffer;
use Jurager\Exchange\Exceptions\ExchangeException;
use Jurager\Exchange\Interfaces\EventDispatcherInterface;
use Jurager\Exchange\Interfaces\ModelBuilderInterface;
use Jurager\Exchange\Interfaces\OfferInterface;
use Jurager\Exchange\Interfaces\ProductInterface;
use Symfony\Component\HttpFoundation\Request;
use Jurager\Commerce\CommerceML;
use Jurager\Commerce\Model\Offer;

/**
 * Class OfferService.
 */
class OfferService
{
    /**
     * @var array Массив идентификаторов торговых предложений которые были добавлены и обновлены
     */
    private $_ids;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Config
     */
    private $config;
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;
    /**
     * @var ModelBuilderInterface
     */
    private $modelBuilder;

    /**
     * CategoryService constructor.
     *
     * @param Request                  $request
     * @param Config                   $config
     * @param EventDispatcherInterface $dispatcher
     * @param ModelBuilderInterface    $modelBuilder
     */
    public function __construct(Request $request, Config $config, EventDispatcherInterface $dispatcher, ModelBuilderInterface $modelBuilder)
    {
        $this->request = $request;
        $this->config = $config;
        $this->dispatcher = $dispatcher;
        $this->modelBuilder = $modelBuilder;
    }

    /**
     * @throws ExchangeException
     */
    public function import()
    {
        $filename = basename($this->request->get('filename'));
        $this->_ids = [];
        $commerce = new CommerceML();
        $commerce->loadOffersXml($this->config->getFullPath($filename));
        if ($offerClass = $this->getOfferClass()) {
            $offerClass::createPriceTypes1c($commerce->offerPackage->getPriceTypes());
        }
        $this->beforeOfferSync();
        foreach ($commerce->offerPackage->getOffers() as $offer) {
            $productId = $offer->getClearId();
            if ($product = $this->findProductModelById($productId)) {
                $model = $product->getOffer1c($offer);
                $this->parseProductOffer($model, $offer);
                $this->_ids[] = $model->getPrimaryKey();
            } else {
                throw new ExchangeException("Продукт $productId не найден в базе");
            }
            unset($model);
        }
        $this->afterOfferSync();
    }

    /**
     * @return OfferInterface|null
     */
    private function getOfferClass(): ?OfferInterface
    {
        return $this->modelBuilder->getInterfaceClass($this->config, OfferInterface::class);
    }

    /**
     * @param string $id
     *
     * @return ProductInterface|null
     */
    protected function findProductModelById(string $id): ?ProductInterface
    {
        /**
         * @var ProductInterface
         */
        $class = $this->modelBuilder->getInterfaceClass($this->config, ProductInterface::class);

        return $class::findProductBy1c($id);
    }

    /**
     * @param OfferInterface $model
     * @param Offer          $offer
     */
    protected function parseProductOffer(OfferInterface $model, Offer $offer): void
    {
        $this->beforeUpdateOffer($model, $offer);
        $this->parseSpecifications($model, $offer);
        $this->parsePrice($model, $offer);
        $this->afterUpdateOffer($model, $offer);
    }

    /**
     * @param OfferInterface $model
     * @param Offer          $offer
     */
    protected function parseSpecifications(OfferInterface $model, Offer $offer)
    {
        foreach ($offer->getSpecifications() as $specification) {
            $model->setSpecification1c($specification);
        }
    }

    /**
     * @param OfferInterface $model
     * @param Offer          $offer
     */
    protected function parsePrice(OfferInterface $model, Offer $offer)
    {
        foreach ($offer->getPrices() as $price) {
            $model->setPrice1c($price);
        }
    }

    public function beforeOfferSync(): void
    {
        $event = new BeforeOffersSync();
        $this->dispatcher->dispatch($event);
    }

    public function afterOfferSync(): void
    {
        $event = new AfterOffersSync($this->_ids);
        $this->dispatcher->dispatch($event);
    }

    /**
     * @param OfferInterface $model
     * @param Offer          $offer
     */
    public function beforeUpdateOffer(OfferInterface $model, Offer $offer)
    {
        $event = new BeforeUpdateOffer($model, $offer);
        $this->dispatcher->dispatch($event);
    }

    /**
     * @param OfferInterface $model
     * @param Offer          $offer
     */
    public function afterUpdateOffer(OfferInterface $model, Offer $offer)
    {
        $event = new AfterUpdateOffer($model, $offer);
        $this->dispatcher->dispatch($event);
    }
}
