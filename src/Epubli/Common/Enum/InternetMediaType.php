<?php

namespace Epubli\Common\Enum;

use MabeEnum\Enum;

/**
 * Internet media type
 * See https://en.wikipedia.org/wiki/Internet_media_type
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */
class InternetMediaType extends Enum
{
    const EPUB = 'application/epub+zip';
    const PDF = 'application/pdf';
    const MD = 'text/markdown';

    public function __toString()
    {
        return $this->getValue();
    }
}