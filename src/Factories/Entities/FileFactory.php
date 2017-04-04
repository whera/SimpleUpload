<?php

namespace WSW\SimpleUpload\Factories\Entities;

use WSW\SimpleUpload\Entities\AbstractEntity;
use WSW\SimpleUpload\Entities\File;
use WSW\SimpleUpload\Factories\AbstractFactory;
use WSW\SimpleUpload\Services\SimpleUpload;

/**
 * Class FileFactory
 * @package WSW\SimpleUpload\Factories\Entities
 */
abstract class FileFactory extends AbstractFactory
{
    /**
     * @param array $data
     * @return File
     */
    public static function createFromArray(array $data)
    {
        $entity = new File();

        if (isset($data['path'])) {
            $entity->setPath($data['path']);
        }

        if (isset($data['timestamp'])) {
            $entity->setTimestamp($data['timestamp']);
        }

        if (isset($data['size'])) {
            $entity->setSize($data['size']);
        }

        if (isset($data['mimetype'])) {
            $entity->setMimetype($data['mimetype']);
        }

        return $entity;
    }

    /**
     * @param SimpleUpload $SimpleUpload
     * @return File
     */
    public static function createFromObject(SimpleUpload $SimpleUpload)
    {
        $arr = [
            'path'      => self::getRealPath(
                $SimpleUpload->getFileSystem()->getAdapter()->getPathPrefix(),
                $SimpleUpload->getNewNameFile()
            ),
            'timestamp' => (int) $SimpleUpload->getFileSystem()->getTimestamp($SimpleUpload->getNewNameFile()),
            'size'      => (int) $SimpleUpload->getFileSystem()->getSize($SimpleUpload->getNewNameFile()),
            'mimetype'  => $SimpleUpload->getFileSystem()->getMimetype($SimpleUpload->getNewNameFile())
        ];

        return self::createFromArray($arr);
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
