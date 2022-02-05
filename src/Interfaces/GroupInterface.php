<?php

namespace Jurager\Exchange\Interfaces;

use Jurager\Commerce\Model\Group;

interface GroupInterface extends IdentifierInterface
{
    /**
     * Создание дерева групп
     * в параметр передаётся массив всех групп (import.xml > Классификатор > Группы)
     * $groups[0]->parent - родительская группа
     * $groups[0]->children - дочерние группы.
     *
     * @param Group[] $groups
     * @param string $merchant_id
     *
     * @return void
     */
    public static function createTree1c($groups, $merchant_id);
}
