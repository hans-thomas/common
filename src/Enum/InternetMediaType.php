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
    const JSON = 'application/json';
    const PDF = 'application/pdf';
    const XHTML = 'application/xhtml+xml';

    const GIF = 'image/gif';
    const JPEG = 'image/jpeg';
    const PNG = 'image/png';

    const CSS = 'text/css';
    const HTML = 'text/html';
    const MD = 'text/markdown';
    const TXT = 'text/plain';

    // Unregistered types (x prefix)
    const NCX = 'application/x-dtbncx+xml';

    public function __toString()
    {
        return $this->getValue();
    }
}