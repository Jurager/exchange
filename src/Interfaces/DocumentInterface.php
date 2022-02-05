<?php

namespace Jurager\Exchange\Interfaces;

interface DocumentInterface
{
    /**
     * Список заказов с сайта.
     *
     * @return DocumentInterface[]
     */
    public static function findDocuments1c();

    /**
     * Список предложений в этом заказе.
     *
     * @return OfferInterface[]
     */
    public function getOffers1c();

    /**
     * Получить список реквизитов в заказе.
     *
     * @return mixed
     */
    public function getRequisites1c();

    /**
     * Получаем контрагента у документа.
     *
     * @return PartnerInterface
     */
    public function getPartner1c();
}