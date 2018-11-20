<?php

namespace Epubli\Common\Enum;

use MabeEnum\Enum;

/**
 * Encoding
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */
class CharacterEncoding extends Enum
{
    const ASCII = 'ASCII';
    const LATIN1 = 'ISO 8859-1';
    const UTF8 = 'UTF-8';
    const UTF16LE = 'UTF-16 LE';
    const UTF16BE = 'UTF-16 BE';
    const UTF32LE = 'UTF-32 LE';
    const UTF32BE = 'UTF-32 BE';

    public function __toString()
    {
        return $this->getValue();
    }
}