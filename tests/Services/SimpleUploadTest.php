<?php

namespace WSW\SimpleUpload\Services;

use League\Flysystem\Adapter\Local;
use WSW\SimpleUpload\TestCase;

/**
 * Class SimpleUploadTest
 * @package WSW\SimpleUpload\Services
 */
class SimpleUploadTest extends TestCase
{
    protected function tearDown()
    {
        $file = $this->path() . 'xpto.png';

        if (file_exists($file)) {
            unlink($file);
        }

        if (!file_exists($this->path() . 'php.png')) {
            copy($this->path() . 'php.png.bkp', $this->path() . 'php.png');
        }
    }

    public function testInstanceStatic()
    {
        $adapter = new Local($this->path());
        $service = SimpleUpload::create($this->getFileExample(), $adapter);

        $this->assertInstanceOf(SimpleUpload::class, $service);

        return $service;
    }

    /**
     * @depends testInstanceStatic
     * @param SimpleUpload $service
     */
    public function testNewNameFile(SimpleUpload $service)
    {
        $service->setName('xpto');
        $this->assertAttributeEquals('xpto', 'newName', $service);
        $this->assertEquals('xpto', $service->getName());
    }

    /**
     * @depends testInstanceStatic
     * @param SimpleUpload $service
     */
    public function testAllowedExtensions(SimpleUpload $service)
    {
        $service->setAllowedExtensions(['png', 'jpg']);

        $this->assertAttributeCount(
            2,
            'allowed_extensions',
            $service
        );
    }

    /**
     * @depends testInstanceStatic
     * @param SimpleUpload $service
     */
    public function testSend(SimpleUpload $service)
    {
        $service->setName('xpto')->send();
        $this->assertTrue(file_exists($this->path() . 'xpto.png'));
    }

    /**
     * @depends testInstanceStatic
     * @param SimpleUpload $service
     */
    public function testRemoveBeforeFileExists(SimpleUpload $service)
    {
        copy($this->path() . 'php.png', $this->path() . 'xpto.png');
        $service->setName('xpto')->send();
        $this->assertTrue(file_exists($this->path() . 'xpto.png'));
    }

    /**
     * @depends testInstanceStatic
     * @param SimpleUpload $service
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidExtensions(SimpleUpload $service)
    {
        $service->setAllowedExtensions(['jpg']);
        $service->send();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testUploadError()
    {
        $adapter = new Local($this->path());
        $service = SimpleUpload::create($this->getUploadError(), $adapter);
        $service->send();
    }

    /**
     * @depends testInstanceStatic
     * @param SimpleUpload $service
     */
    public function testPath(SimpleUpload $service)
    {
        $service->setPath('/root');
        $this->assertEquals('/root/', $service->getPath());
    }

    /**
     * @depends testInstanceStatic
     * @param SimpleUpload $service
     */
    public function testPathLocalAbsolut(SimpleUpload $service)
    {
        $service->setPathLocal('/root', '/');
        $this->assertEquals('/root/', $service->getPath());
    }

    /**
     * @depends testInstanceStatic
     * @param SimpleUpload $service
     */
    public function testPathLocal(SimpleUpload $service)
    {
        $service->setPathLocal('/root', 'test/');
        $this->assertEquals('/root/', $service->getPath());
    }
}
