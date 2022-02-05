<?php

namespace Jurager\Exchange\Interfaces;

interface PriceTypeInterface extends IdentifierInterface
{
    /**
     * Создание списка типов цен
     * в параметр передаётся массив всех типов цен (import.xml > Классификатор > ТипыЦен)
     *
     * @param $priceTypes
     * @param $merchant_id
     *
     * @return void
     */
    public static function createPriceTypes1c($priceTypes, $merchant_id);
}
