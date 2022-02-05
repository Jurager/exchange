<?php

namespace Jurager\Exchange;

use Jurager\Exchange\Exceptions\ExchangeException;
use Jurager\Exchange\Interfaces\ModelBuilderInterface;

/**
 * Class ModelBuilder.
 */
class ModelBuilder implements ModelBuilderInterface
{
    /**
     * Если модель в конфиге не установлена, то импорт не будет произведен.
     *
     * @param Config $config
     * @param string $interface
     *
     * @throws ExchangeException
     *
     * @return null|mixed
     */
    public function getInterfaceClass(Config $config, string $interface)
    {
        $model = $config->getModelClass($interface);

        if ($model) {

            $modelInstance = new $model();

            if ($modelInstance instanceof $interface) {
                return $modelInstance;
            }
        }

        throw new ExchangeException(sprintf('Model %s not instantiable interface %s', $config->getModelClass($interface), $interface));
    }
}
