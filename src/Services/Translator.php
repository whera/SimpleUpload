<?php

namespace WSW\SimpleUpload\Services;

use RuntimeException;

/**
 * Class Translator
 * @package WSW\SimpleUpload\Services
 */
class Translator
{
    /**
     * @var string
     */
    private $locate = 'en-US';

    /**
     * @var array
     */
    private $messages = [];

    public function __construct($locate = 'en-US')
    {
        $this->loadMessages($this->locate);

        if (!$this->existsFile($locate)) {
            $msg = sprintf($this->getMessage('errors.translate.fileNotFound'), $locate);
            throw new RuntimeException($msg, 404);
        }

        if ($locate !== 'en-US') {
            $this->locate = $locate;
            $this->loadMessages($this->locate);
        }
    }

    public static function locate($locate = 'en-US')
    {
        return new self($locate);
    }

    /**
     * @return string
     */
    public function getLocate()
    {
        return $this->locate;
    }

    /**
     * @param string $locate
     * @return self
     */
    public function setLocate($locate)
    {
        $this->locate = $locate;
        return $this;
    }

    public function getMessage($value)
    {
        $keys = (array) $value;
        if (strpos($value, '.')) {
            $keys = explode('.', $value);
        }
        return $this->searchKey($keys);
    }

    private function searchKey(array $keys)
    {
        $result = $this->messages;

        foreach($keys as $item) {
            if (is_array($result) && isset($result[$item])) {
                $result = $result[$item];
            }
        }

        return $result;
    }

    private function existsFile($file)
    {
        $locate = mb_strtolower($file);
        $locate = rtrim($locate,  '.php');
        $file   = $this->path() . DIRECTORY_SEPARATOR . $locate . '.php';

        return (bool) file_exists($file);
    }

    private function path()
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Translations';
    }

    private function loadMessages($locate)
    {
        $locate = mb_strtolower($locate);
        $locate = rtrim($locate,  '.php');
        $this->messages = require ($this->path() . DIRECTORY_SEPARATOR . $locate . '.php');

        return $this;
    }
}
