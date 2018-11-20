<?php

namespace Epubli\Common\Enum;

use Epubli\Common\Basic\Enum;

/**
 * Encoding
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 *
 * @method static CharacterEncoding ASCII()
 * @method static CharacterEncoding LATIN1()
 * @method static CharacterEncoding UTF8()
 * @method static CharacterEncoding UTF16LE()
 * @method static CharacterEncoding UTF16BE()
 * @method static CharacterEncoding UTF32LE()
 * @method static CharacterEncoding UTF32BE()
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
}