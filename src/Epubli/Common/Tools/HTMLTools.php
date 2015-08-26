<?php

namespace Epubli\Common\Tools;

class HTMLTools
{
    public static function convertEntitiesNamedToNumeric($html)
    {
        return strtr($html, include('htmlEntityMap.php'));
    }

    public static function isBlockLevelElement($name)
    {
        return in_array($name, include('htmlBlockLevelElements.php'));
    }
}