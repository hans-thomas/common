<?php

namespace Epubli\Common\Tools;

class StringTools
{
    /**
     * Strip non-ascii characters
     * @see http://stackoverflow.com/questions/8781911/remove-non-ascii-characters-from-string-in-php#answer-8781968

     * @param $text string with non-ascii characters
     * @return string with non-ascii characters replaced by underscores
     */
    public static function stripNonAsciiChars($text)
    {
        return preg_replace('/[[:^print:]]/', '_', $text);
    }
}