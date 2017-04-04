<?php

namespace WSW\SimpleUpload\Entities;

use DateTime;

/**
 * Class File
 * @package WSW\SimpleUpload\Entities
 */
class File
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var DateTime
     */
    private $timestamp;

    /**
     * @var string
     */
    private $mimetype;

    /**
     * @var int
     */
    private $size;

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     * @return self
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = (new DateTime())->setTimestamp($timestamp);
        return $this;
    }

    /**
     * @return string
     */
    public function getMimetype()
    {
        return $this->mimetype;
    }

    /**
     * @param string $mimetype
     *
     * @return self
     */
    public function setMimetype($mimetype)
    {
        $this->mimetype = $mimetype;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return self
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return dirname($this->getPath());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return pathinfo($this->getPath(), PATHINFO_FILENAME);
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return basename($this->getPath());
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return strtolower(pathinfo($this->getPath(), PATHINFO_EXTENSION));
    }
}
