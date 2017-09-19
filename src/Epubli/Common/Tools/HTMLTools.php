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
        ['title', 'br', 'p', 'h1','h2','h3','h4','h5','span','div','i','strong','b', 'table', 'td', 'th', 'tr'],
        $drop =
        ['head','style']
    )
    {
        foreach($drop as $dumpTag) {
            $html = preg_replace("/<$dumpTag.*$dumpTag>/is","\n",$html);
        }
        $html = preg_replace("/[\n\r ]{2,}/i","\n",$html);
        $html = preg_replace("/[\n|\r]/i",'<br />',$html);

        /* @TODO: remove style tags and only keep body content (drop head) */
        $tempFunc = function($matches) use ($keep) {
            $htmlNode = "<" . $matches[1] . ">" . strip_tags($matches[2]) . "</" . $matches[1] . ">";
            if (in_array($matches[1],$keep)) {
                return " ".$htmlNode." ";
            } else {
                return false;
            }
        };

        $allowedTags = implode(array_values($keep),"|");
        $regExp = '@<('.$allowedTags.')[^>]*?>(.*?)<\/\1>@i';
        $strippedHtml = preg_replace_callback($regExp,$tempFunc,$html);

        $strippedHtml = strip_tags($strippedHtml,"<".implode("><",$keep).">");

        return $strippedHtml;
    }
}