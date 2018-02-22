<?php

namespace Epubli\Common\Tests\Tools;

use Epubli\Common\Tools\StringTools;
use Epubli\Common\Tools\UnitTools;
use PHPUnit_Framework_TestCase;

class UnitToolsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param float $mm value in mm
     * @param float $pt value in pt
     * @dataProvider provideData
     */
    public function testMmToPt($mm, $pt)
    {
        $this->assertEquals($pt, UnitTools::mmToPt($mm), '', 0.00001);
    }

    /**
     * @param float $mm value in mm
     * @param float $pt value in pt
     * @dataProvider provideData
     */
    public function testPtToMm($mm, $pt)
    {
        $this->assertEquals($mm, UnitTools::ptToMm($pt), '', 0.00001);
    }

    public function provideData() {
        return [
            [3, 8.503937],
            [1.058333, 3],
            [14.816667, 42],
            [42, 119.055118],
        ];
    }
}