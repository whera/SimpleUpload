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
class UploadFactory extends AbstractFactory
{

    /**
     * @param array $data
     * @param Translator|null $translator
     * @return Upload
     */
    public static function createFromArray(array $data, Translator $translator = null)
    {
        $translator  = $translator ?: Translator::locate();

        if (!array_key_exists('name', $data)) {
            $msg = sprintf($translator->getMessage('validations.requiredField'), 'name');
            throw new InvalidArgumentException($msg, 400);
        }

        if (!array_key_exists('type', $data)) {
            $msg = sprintf($translator->getMessage('validations.requiredField'), 'type');
            throw new InvalidArgumentException($msg, 400);
        }

        if (!array_key_exists('tmp_name', $data)) {
            $msg = sprintf($translator->getMessage('validations.requiredField'), 'tmp_name');
            throw new InvalidArgumentException($msg, 400);
        }

        if (!array_key_exists('error', $data)) {
            $msg = sprintf($translator->getMessage('validations.requiredField'), 'error');
            throw new InvalidArgumentException($msg, 400);
        }

        if (!array_key_exists('size', $data)) {
            $msg = sprintf($translator->getMessage('validations.requiredField'), 'size');
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
