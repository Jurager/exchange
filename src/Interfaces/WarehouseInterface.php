<?php

namespace Jurager\Exchange\Interfaces;

interface WarehouseInterface extends IdentifierInterface
{
    /**
     * Создание списка складов
     * в параметр передаётся массив всех сладов (import.xml > Классификатор > склады)
     *
     * @param $warehouses
     * @param $merchant_id
     *
     * @return void
     */
    public static function createWarehouse1c($warehouses, $merchant_id);
}