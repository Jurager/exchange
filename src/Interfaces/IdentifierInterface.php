<?php

namespace Jurager\Exchange\Interfaces;

interface IdentifierInterface
{
    /**
     * Возвращаем имя поля в базе данных, в котором хранится ID из 1С
     *
     * @return string
     */
    public static function getIdFieldName1c();

    /**
     * Возвращаем id сущности.
     *
     * @return int|string
     */
    public function getPrimaryKey();
}
