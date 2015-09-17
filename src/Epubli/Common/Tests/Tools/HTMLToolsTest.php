<?php

namespace Epubli\Common\Tests\Tools;

use Epubli\Common\Tools\HTMLTools;
use PHPUnit_Framework_TestCase;

class HTMLToolsTest extends PHPUnit_Framework_TestCase
{
    public function testConvertEntitiesNamedToNumeric()
    {
        $this->assertEquals('&#160;', HTMLTools::convertEntitiesNamedToNumeric('&nbsp;'));
    }

    public function testIsBlockLevelElement()
    {
        $this->assertTrue(HTMLTools::isBlockLevelElement('div'));
        $this->assertFalse(HTMLTools::isBlockLevelElement('a'));
    }
}