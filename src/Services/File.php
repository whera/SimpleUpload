<?php

namespace WSW\SimpleUpload\Services;

/**
 * Class File
 * @package WSW\SimpleUpload\Services
 */
class File
{
    /**
     * @var SimpleUpload
     */
    private $simple_upload;

    /**
     * @param SimpleUpload $simple_upload
     */
    public function __construct(SimpleUpload $simple_upload)
    {
        $this->simple_upload = $simple_upload;
    }

    /**
     * @return string
     */
    public function getRealPath()
    {
        return $this->path() . $this->simple_upload->getNewNameFile();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return pathinfo($this->getRealPath(), PATHINFO_FILENAME);
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->simple_upload->getNewNameFile();
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path();
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return strtolower(pathinfo($this->getRealPath(), PATHINFO_EXTENSION));
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return (int) $this->simple_upload->getFileSystem()->getSize($this->simple_upload->getNewNameFile());
    }

    /**
     * @return string
     */
    public function getMimetype()
    {
        return $this->simple_upload->getFileSystem()->getMimetype($this->simple_upload->getNewNameFile());
    }

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return (int) $this->simple_upload->getFileSystem()->getTimestamp($this->simple_upload->getNewNameFile());
    }

    /**
     * @return string
     */
    private function path()
    {
        $path = $this->simple_upload->getFileSystem()->getAdapter()->getPathPrefix();
        if (null === $path) {
            return DIRECTORY_SEPARATOR;
        }

        return ($path{0} !== DIRECTORY_SEPARATOR) ? DIRECTORY_SEPARATOR . $path : $path;
    }
}
