<?php

namespace WSW\SimpleUpload\Traits\Upload;


trait Path
{

    /**
     * @param string $base
     * @param string $dir
     * @return string
     */
    private function setPathLocal($base, $dir)
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
        if ($this->file_system->getAdapter() instanceof Local) {
            $base = $this->file_system->getAdapter()->getPathPrefix();
            $path =  $this->setPathLocal($base, $path);
        }

        $this->file_system->getAdapter()->setPathPrefix($path);
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->file_system->getAdapter()->getPathPrefix();
    }
}