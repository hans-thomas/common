<?php

namespace Epubli\Common\Enum;

use Epubli\Common\Basic\Enum;

/**
 * Internet media type
 * See https://en.wikipedia.org/wiki/Internet_media_type
 * This enumeration is obviously not exhaustive. It will never be. Types are added when needed.
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 *
 * @method static InternetMediaType EPUB()
 * @method static InternetMediaType JSON()
 * @method static InternetMediaType PDF()
 * @method static InternetMediaType XHTML()
 * @method static InternetMediaType GIF()
 * @method static InternetMediaType JPEG()
 * @method static InternetMediaType PNG()
 * @method static InternetMediaType CSS()
 * @method static InternetMediaType HTML()
 * @method static InternetMediaType MD()
 * @method static InternetMediaType TXT()
 * @method static InternetMediaType NCX()
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
}