<?php

namespace WSW\SimpleUpload\Factories\Entities;

use InvalidArgumentException;
use WSW\SimpleUpload\Entities\Upload;
use WSW\SimpleUpload\Factories\AbstractFactory;
use WSW\SimpleUpload\Services\Translator;

/**
 * Class UploadFactory
 * @package WSW\SimpleUpload\Factories\Entities
 */
abstract class UploadFactory extends AbstractFactory
{

    /**
     * @param array $data
     * @param Translator|null $translator
     * @return Upload
     */
    public static function createFromArray(array $data, Translator $translator = null)
    {
        $translator = $translator ?: Translator::locate();
        $arr = ['name' => null, 'type' => null, 'tmp_name' => null, 'error' => null, 'size' => null];

        $compare = array_diff_key($arr, $data);

        if (!empty($compare)) {
            $fields = array_keys($compare);
            $msg = sprintf($translator->getMessage('validations.requiredField'), $fields[0]);
            throw new InvalidArgumentException($msg, 400);
        }

        $entity = (new Upload())
            ->setName($data['name'])
            ->setType($data['type'])
            ->setTmpName($data['tmp_name'])
            ->setError($data['error'])
            ->setSize($data['size']);

        return $entity;
    }
}
