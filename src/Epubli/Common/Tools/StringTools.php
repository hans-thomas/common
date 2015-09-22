<?php

namespace Epubli\Common\Tools;

class StringTools
{
    /**
     * Replace only first occurrence of a substring.
     * @param string $search The substring to be replaced.
     * @param string $replace The replacement string.
     * @param string $subject The original string.
     * @return string The resulting string.
     */
    public static function replaceFirstOccurrence($search, $replace, $subject)
    {
        $pos = strpos($subject, $search);
        return $pos === false ? $subject : substr_replace($subject, $replace, $pos, strlen($search));
    }

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