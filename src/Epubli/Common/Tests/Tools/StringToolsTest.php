<?php

namespace Epubli\Common\Tests\Tools;

use Epubli\Common\Tools\StringTools;
use PHPUnit_Framework_TestCase;

class StringToolsTest extends PHPUnit_Framework_TestCase
{
    public function testStripNonAsciiChars()
    {
        $this->assertEquals(
            'Sch__ne Gr____e, Sch__tzchen!',
            StringTools::stripNonAsciiChars('Schöne Grüße, Schätzchen!')
        );
    }
}