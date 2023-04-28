<?php

namespace Jurager\Exchange\Interfaces;

interface WarehouseInterface extends IdentifierInterface
{
    /**
     * Создание списка складов
     * в параметр передаётся массив всех сладов (import.xml > Классификатор > склады)
     *
     * @param $warehouses
     * @param $source_id
     *
     * @return void
     */
    public static function createWarehouse1c($warehouses, $source_id);
}