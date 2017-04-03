<?php

namespace WSW\SimpleUpload\Factories;

use WSW\SimpleUpload\Entities\AbstractEntity;

/**
 * Class AbstractFactory
 * @package WSW\SimpleUpload\Factories
 */
abstract class AbstractFactory
{
    /**
     * @param array $data
     * @return AbstractEntity
     */
    abstract public static function createFromArray(array $data);
}
