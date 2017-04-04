<?php

namespace WSW\SimpleUpload\Traits\Upload;

use League\Flysystem\Adapter\Local;

/**
 * Trait Validations
 * @package WSW\SimpleUpload\Traits\Upload
 */
trait Validations
{
    /**
     * @param string $ext
     * @param array $list
     * @return bool
     */
    private function extensionIsValid($ext, array $list)
    {
        if (empty($list)) {
            return true;
        }

        return (bool) in_array($ext, $list);
    }

    /**
     * @return bool
     */
    private function uploadWithError()
    {
        return (bool) $this->getError();
    }
}
