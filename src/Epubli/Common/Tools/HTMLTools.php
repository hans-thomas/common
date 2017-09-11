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

    public static function stripHtmlTags(
        $html,
        $keep =
        ['br' => '\n', 'p' => '\n', 'h1' => '*$2*', 'h2' => '*$2*', 'h3' => '*$2*', 'h4' => '*$2*', 'h5' => '*$2*', 'span' => '$2', 'a' => '$2', 'div' => '$2'])
    {
        $tempFunc = function($matches) use ($keep) {
            return $matches[2];
        };
        $def='[^>]*';
        $allowedTags = implode(array_keys($keep),"|");
        $regExp = '@<('.$allowedTags.')>([^<]*)<\/\1>@i';
        $strippedHtml = strip_tags(preg_replace_callback($regExp,$tempFunc,$html));
        return $strippedHtml;
    }
}