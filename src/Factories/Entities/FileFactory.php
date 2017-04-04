<?php

namespace WSW\SimpleUpload\Factories\Entities;

use InvalidArgumentException;
use WSW\SimpleUpload\Entities\AbstractEntity;
use WSW\SimpleUpload\Entities\File;
use WSW\SimpleUpload\Factories\AbstractFactory;
use WSW\SimpleUpload\Services\SimpleUpload;
use WSW\SimpleUpload\Services\Translator;

/**
 * Class FileFactory
 * @package WSW\SimpleUpload\Factories\Entities
 */
abstract class FileFactory extends AbstractFactory
{
    /**
     * @param array $data
     * @param Translator|null $translator
     * @return \WSW\SimpleUpload\Entities\File
     */
    public static function createFromArray(array $data, Translator $translator = null)
    {
        $translator = $translator ?: Translator::locate();
        $arr = ['path' => null, 'timestamp' => null, 'size' => null, 'mimetype' => null];
        $compare = array_diff_key($arr, $data);

        if (!empty($compare)) {
            $fields = array_keys($compare);
            $msg = sprintf($translator->getMessage('validations.requiredField'), $fields[0]);
            throw new InvalidArgumentException($msg, 400);
        }

        $entity = new File();
        $entity->setPath($data['path']);
        $entity->setTimestamp($data['timestamp']);
        $entity->setSize($data['size']);
        $entity->setMimetype($data['mimetype']);

        return $entity;
    }

    /**
     * @param SimpleUpload $SimpleUpload
     * @return File
     */
    public static function createFromObject(SimpleUpload $SimpleUpload)
    {
        $arr = [
            'path' => self::getRealPath(
                $SimpleUpload->getFileSystem()->getAdapter()->getPathPrefix(),
                $SimpleUpload->getNewNameFile()
            ),
            'timestamp' => (int) $SimpleUpload->getFileSystem()->getTimestamp($SimpleUpload->getNewNameFile()),
            'size'      => (int) $SimpleUpload->getFileSystem()->getSize($SimpleUpload->getNewNameFile()),
            'mimetype'  => $SimpleUpload->getFileSystem()->getMimetype($SimpleUpload->getNewNameFile())
        ];

        return self::createFromArray($arr, $SimpleUpload->getTranslator());
    }

    /**
     * @param null $path
     * @param string $file
     * @return string
     */
    public static function getRealPath($path = null, $file = null)
    {
        if (null === $path) {
            $path = DIRECTORY_SEPARATOR;
        }

        $realPath = ($path{0} !== DIRECTORY_SEPARATOR) ? DIRECTORY_SEPARATOR . $path : $path;
        return $realPath . $file;
    }
}
