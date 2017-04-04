<?php

namespace WSW\SimpleUpload\Traits\Upload;

use League\Flysystem\Adapter\Local;

trait Path
{
    /**
     * @param string $base
     * @param string $dir
     * @return string
     */
    public function setPathLocal($base, $dir)
    {
        if (DIRECTORY_SEPARATOR === $dir{0}) {
            return $dir;
        }

        return $base . ltrim($dir, DIRECTORY_SEPARATOR);
    }

    /**
     * @param string $path
     * @return self
     */
    public function setPath($path)
    {
        if ($this->getAdapter() instanceof Local) {
            $base = $this->getAdapter()->getPathPrefix();
            $path =  $this->setPathLocal($base, $path);
        }

        $this->getAdapter()->setPathPrefix($path);
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->getAdapter()->getPathPrefix();
    }
}
