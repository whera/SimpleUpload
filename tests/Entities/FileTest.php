<?php

namespace WSW\SimpleUpload\Entities;

use WSW\SimpleUpload\TestCase;

/**
 * Class FileTest
 * @package WSW\SimpleUpload\Entities
 */
class FileTest extends TestCase
{

    public function testInstanceEntity()
    {
        $this->assertInstanceOf(File::class, new File());
    }

    public function testSetsMethods()
    {
        $file   = $this->getFileExample();
        $entity = new File();

        $entity->setPath($file['tmp_name']);
        $entity->setSize($file['size']);
        $entity->setMimetype($file['type']);
        $entity->setTimestamp(1491310673);

        $this->assertAttributeEquals($file['tmp_name'], 'path', $entity);
        $this->assertAttributeEquals($file['size'], 'size', $entity);
        $this->assertAttributeEquals($file['type'], 'mimetype', $entity);
        $this->assertAttributeInstanceOf(\DateTime::class, 'timestamp', $entity);

        return $entity;
    }

    /**
     * @depends testSetsMethods
     * @param File $entity
     */
    public function testGetsMethods(File $entity)
    {
        $file = $this->getFileExample();
        $fileName = pathinfo($file['tmp_name'], PATHINFO_FILENAME);
        $fileExt  = pathinfo($file['name'], PATHINFO_EXTENSION);
        $pathFile = dirname($file['tmp_name']);

        $this->assertEquals($file['tmp_name'], $entity->getPath());
        $this->assertEquals($file['size'], $entity->getSize());
        $this->assertEquals($file['type'], $entity->getMimetype());
        $this->assertEquals($file['name'], $entity->getFileName());
        $this->assertEquals($pathFile, $entity->getFilePath());
        $this->assertEquals($fileName, $entity->getName());
        $this->assertEquals($fileExt, $entity->getExtension());
        $this->assertInstanceOf(\DateTime::class, $entity->getTimestamp());
    }
}
