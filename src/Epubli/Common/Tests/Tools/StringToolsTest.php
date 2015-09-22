<?php

namespace Epubli\Common\Tests\Tools;

use Epubli\Common\Tools\StringTools;
use PHPUnit_Framework_TestCase;

class StringToolsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param string $search The substring to be replaced.
     * @param string $replace The replacement string.
     * @param string $subject The original string.
     * @param string $expected The expected result.
     * @dataProvider provideReplaceFirstOccurrenceData
     */
    public function testReplaceFirstOccurrence($search, $replace, $subject, $expected)
    {
        $result = StringTools::replaceFirstOccurrence($search, $replace, $subject);
        $this->assertEquals($expected, $result);
    }

    public function provideReplaceFirstOccurrenceData()
    {
        return [
            ['needle', 'camel', 'Haystack containing a needle.', 'Haystack containing a camel.'],
            ['needle', 'camel', 'Needlestack containing a needle.', 'Needlestack containing a camel.'],
            ['Needle', 'Camel', 'Needlestack containing a needle.', 'Camelstack containing a needle.'],
            ['/\\$.*?()[]^', '\\1$1', '/\\$.*?()[]^/\\$.*?()[]^', '\\1$1/\\$.*?()[]^'],
        ];
    }

    public function testStripNonAsciiChars()
    {
        $this->assertEquals(
            'Sch__ne Gr____e, Sch__tzchen!',
            StringTools::stripNonAsciiChars('Schöne Grüße, Schätzchen!')
        );
    }
}