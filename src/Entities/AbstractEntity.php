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
    abstract public function toArray();
}
