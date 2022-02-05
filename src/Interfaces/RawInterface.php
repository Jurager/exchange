<?php

namespace Jurager\Exchange\Interfaces;

use Jurager\Commerce\CommerceML;
use Jurager\Commerce\Model\Simple;

interface RawInterface
{
    /**
     * @param CommerceML $cml
     * @param Simple $object
     *
     * @return mixed
     */
    public function setRaw1cData(CommerceML $cml, Simple $object);
}