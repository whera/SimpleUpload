<?php

namespace WSW\SimpleUpload\Factories\Entities;

use League\Flysystem\Adapter\Local;
use WSW\SimpleUpload\Services\SimpleUpload;
use WSW\SimpleUpload\TestCase;
use WSW\SimpleUpload\Entities\File;

/**
 * Class FileFactoryTest
 * @package WSW\SimpleUpload\Factories\Entities
 */
class FileFactoryTest extends TestCase
{
    public function testFactoryMethodsExists()
    {
        $object = new FileFactory();
        $this->assertTrue(method_exists($object, 'createFromArray'));
        $this->assertTrue(method_exists($object, 'createFromObject'));
    }

    public function testReturnInstanceFactoryClass()
    {
        $this->assertInstanceOf(File::class, FileFactory::createFromArray($this->getArrayFile()));
    }

    public function testReturnInstanceFactoryClassFromObject()
    {
        $adapter = new Local($this->path());
        $service = new SimpleUpload($this->getFileExample(), $adapter);

        $this->assertInstanceOf(File::class, FileFactory::createFromObject($service));
    }

    public function testMethodPath()
    {
        $path = FileFactory::getRealPath(null, 'xpto.txt');
        $this->assertEquals(DIRECTORY_SEPARATOR . 'xpto.txt', $path);
    }


    private function path()
    {
        return dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Files' . DIRECTORY_SEPARATOR;
    }
}
