<?php

namespace WSW\SimpleUpload\Factories\Entities;

use WSW\SimpleUpload\TestCase;
use WSW\SimpleUpload\Entities\Upload;

/**
 * Class UploadFactoryTest
 * @package WSW\SimpleUpload\Factories\Entities
 */
class UploadFactoryTest extends TestCase
{
    public function testReturnInstanceFactoryClass()
    {
        $this->assertInstanceOf(Upload::class, UploadFactory::createFromArray($this->getFileExample()));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider additionProvider
     *
     */
    public function testExceptions(array $arr)
    {
        UploadFactory::createFromArray($arr);
    }

    public function additionProvider()
    {
        return [
            [['namex' => 'php.png', 'type' => 'image/png', 'tmp_name' =>'/tmp/php.png', 'error' => 0, 'size' => 94762]],
            [['name' => 'php.png', 'typex' => 'image/png', 'tmp_name' =>'/tmp/php.png', 'error' => 0, 'size' => 94762]],
            [['name' => 'php.png', 'type' => 'image/png', 'tmp_namex' =>'/tmp/php.png', 'error' => 0, 'size' => 94762]],
            [['name' => 'php.png', 'type' => 'image/png', 'tmp_name' =>'/tmp/php.png', 'errorx' => 0, 'size' => 94762]],
            [['name' => 'php.png', 'type' => 'image/png', 'tmp_name' =>'/tmp/php.png', 'error' => 0, 'sizex' => 94762]]
        ];
    }
}
