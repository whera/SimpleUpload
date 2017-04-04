<?php

namespace WSW\SimpleUpload\Support;

use WSW\SimpleUpload\TestCase;

/**
 * Class TextTest
 * @package WSW\SimpleUpload\Support
 */
class TextTest extends TestCase
{
    /**
     * @codeCoverageIgnore
     */
    public function testNotFoundExtension()
    {
        $slug = Text::slug('ÁBCD', '-', ['Á']);
        $this->assertEquals('abcd', $slug);
    }
}
