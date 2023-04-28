<?php

namespace Jurager\Exchange\Interfaces;

use Jurager\Commerce\CommerceML;
use Jurager\Commerce\Model\Offer;
use Jurager\Commerce\Model\Product;

/**
 * Interface ProductInterface.
 */
interface ProductInterface extends IdentifierInterface
{
    /**
     * Получение уникального идентификатора продукта в рамках БД сайта.
     *
     * @return int|string
     */
    public function getPrimaryKey();

    /**
     * Если по каким-то причинам файлы import.xml или offers.xml были модифицированы и какие-то данные
     * не попадают в парсер, в самом конце вызывается данный метод, в $product и $cml можно получить все
     * возможные данные для ручного парсинга.
     *
     * @param CommerceML $cml
     * @param Product $product
     *
     * @return void
     */
    public function setRaw1cData($cml, $product);

    /**
     * Установка реквизитов, (import.xml > Каталог > Товары > Товар > ЗначенияРеквизитов > ЗначениеРеквизита)
     * $name - Наименование
     * $value - Значение.
     *
     * @param string $name
     * @param string $value
     *
     * @return void
     */
    public function setRequisite1c($name, $value);

    /**
     * Предполагается, что дерево групп у вас уже создано
     *
     * @param \Jurager\Commerce\Model\Group $group
     *
     * @return mixed
     */
    public function setGroup1c($group);

    /**
     * import.xml > Классификатор > Свойства > Свойство
     * $property - Свойство товара.
     *
     * import.xml > Классификатор > Свойства > Свойство > Значение
     * $property->value - Разыменованное значение (string)
     *
     * import.xml > Классификатор > Свойства > Свойство > ВариантыЗначений > Справочник
     * $property->getValueModel() - Данные по значению, Ид значения, и т.д
     *
     * @param string $property_id
     * @param string $value
     *
     * @return void
     */
    public function setProperty1c($property_id, $value);

    /**
     * @param string $path
     * @param string $caption
     *
     * @return void
     */
    public function addImage1c($path, $caption);

    /**
     * @return GroupInterface
     */
    public function getGroup1c();

    /**
     * Создание всех свойств продутка
     * import.xml > Классификатор > Свойства.
     *
     * $properties[]->availableValues - список доступных значений, для этого свойства
     * import.xml > Классификатор > Свойства > Свойство > ВариантыЗначений > Справочник
     *
     * @param $properties
     * @param string $source_id
     *
     * @return mixed
     */
    public static function createProperties1c($properties, string $source_id);

    /**
     * @param Offer $offer
     *
     * @return OfferInterface
     */
    public function getOffer1c($offer);

    /**
     * @param Product $product
     * @param string $source_id
     *
     * @return self
     */
    public static function createModel1c($product, $source_id);

    /**
     * @param string $id
     * @param string $source_id
     * @return ProductInterface|null
     */
    public static function findProductBy1c(string $id, string $source_id): ?self;
}
