<?php

namespace WSW\SimpleUpload\Services;

use League\Flysystem\AdapterInterface;

/**
 * Class AbstractUpload
 * @package WSW\SimpleUpload\Services
 */
abstract class AbstractUpload
{
    /**
     * @return AdapterInterface
     */
    abstract public function getAdapter();
}
