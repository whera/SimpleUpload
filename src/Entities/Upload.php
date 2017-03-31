<?php

namespace WSW\SimpleUpload\Entities;

/**
 * Class File
 * @package WSW\SimpleUpload\Entities
 */
class Upload extends AbstractEntity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $tmp_name;

    /**
     * @var int
     */
    private $error;

    /**
     * @var int
     */
    private $size;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getTmpName()
    {
        return $this->tmp_name;
    }

    /**
     * @param string $tmp_name
     * @return self
     */
    public function setTmpName($tmp_name)
    {
        $this->tmp_name = $tmp_name;
        return $this;
    }

    /**
     * @return int
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param int $error
     * @return self
     */
    public function setError($error)
    {
        $this->error = $error;
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
    public function getFileName()
    {
        return pathinfo($this->getName(), PATHINFO_FILENAME);
    }

    /**
     * @return string
     */
    public function getFileExtension()
    {
        return pathinfo($this->getName(), PATHINFO_EXTENSION);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name'     => $this->getName(),
            'type'     => $this->getType(),
            'tmp_name' => $this->getTmpName(),
            'error'    => $this->getError(),
            'size'     => $this->getSize(),
        ];
    }
}
