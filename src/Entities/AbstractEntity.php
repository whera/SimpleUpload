<?php

namespace WSW\SimpleUpload\Entities;

/**
 * Class AbstractEntity
 * @package WSW\SimpleUpload\Entities
 */
abstract class AbstractEntity
{
    /**
     * @return array
     */
    public abstract function toArray();
}
