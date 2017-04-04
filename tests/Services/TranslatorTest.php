<?php

namespace WSW\SimpleUpload\Services;

use WSW\SimpleUpload\TestCase;

/**
 * Class TranslatorTest
 * @package WSW\SimpleUpload\Services
 */
class TranslatorTest extends TestCase
{
    public function testInstanceEntity()
    {
        $this->assertInstanceOf(Translator::class, new Translator());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testExceptionNotFoundFile()
    {
        $locate = new Translator('WSW-XT');
    }

    public function testLoadLocate()
    {
        $pt = Translator::locate('pt-BR');
    }

    public function testGetLocate()
    {
        $pt = Translator::locate('pt-BR');
        $this->assertEquals('pt-BR', $pt->getLocate());
    }

    public function testSetLocate()
    {
        $pt = Translator::locate('pt-BR');
        $pt->setLocate('en-US');

        $this->assertAttributeEquals('en-US', 'locate', $pt);
    }
}
