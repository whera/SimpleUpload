<?php

namespace WSW\SimpleUpload\Entities;

use WSW\SimpleUpload\TestCase;

/**
 * Class UploadTest
 * @package WSW\SimpleUpload\Entities
 */
class UploadTest extends TestCase
{

    public function testInstanceEntity()
    {
        $this->assertInstanceOf(Upload::class, new Upload());
    }

    public function testSetsMethods()
    {
        $file   = $this->getFileExample();
        $entity = new Upload();

        $entity->setName($file['name']);
        $entity->setSize($file['size']);
        $entity->setError($file['error']);
        $entity->setTmpName($file['tmp_name']);
        $entity->setType($file['type']);

        $this->assertAttributeEquals($file['name'], 'name', $entity);
        $this->assertAttributeEquals($file['size'], 'size', $entity);
        $this->assertAttributeEquals($file['error'], 'error', $entity);
        $this->assertAttributeEquals($file['tmp_name'], 'tmp_name', $entity);
        $this->assertAttributeEquals($file['type'], 'type', $entity);

        return $entity;
    }

    /**
     * @depends testSetsMethods
     * @param Upload $entity
     */
    public function testGetsMethods(Upload $entity)
    {
        $file = $this->getFileExample();
        $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
        $fileExt  = pathinfo($file['name'], PATHINFO_EXTENSION);

        $this->assertEquals($file['name'], $entity->getName());
        $this->assertEquals($file['size'], $entity->getSize());
        $this->assertEquals($file['error'], $entity->getError());
        $this->assertEquals($file['tmp_name'], $entity->getTmpName());
        $this->assertEquals($file['type'], $entity->getType());
        $this->assertEquals($fileName, $entity->getFileName());
        $this->assertEquals($fileExt, $entity->getFileExtension());
        $this->assertEquals($file, $entity->toArray());
    }

}
