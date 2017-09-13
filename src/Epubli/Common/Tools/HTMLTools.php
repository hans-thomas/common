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
        ['br', 'p', 'h1','h2','h3','h4','h5','span','div','i','strong','b'])
    {
        /* @TODO: remove style tags and only keep body content (drop head) */
        $tempFunc = function($matches) use ($keep) {
            $htmlNode = "<" . $matches[1] . ">" . $matches[2] . "</" . $matches[1] . ">";
            if (in_array($matches[1],$keep)) {
                return $htmlNode;
            } else {
                return false;
            }
        };

        $def='[^>]*';
        $allowedTags = implode(array_values($keep),"|");
        $regExp = '@<(.*)[^>]*?>(.*?)<\/\1>@i';
        $strippedHtml = preg_replace_callback($regExp,$tempFunc,$html);

        return $strippedHtml;
    }
}