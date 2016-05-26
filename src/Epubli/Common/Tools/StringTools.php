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

    /**
     * Determine whether one string starts with another. 
     * @param string $haystack String to examine.
     * @param string $needle String to find.
     * @return bool Whether $haystack starts with $needle.
     */
    public static function startsWith($haystack, $needle)
    {
        return '' === $needle || strpos($haystack, $needle) === 0;
    }

    /**
     * Determine whether one string ends with another.
     * @param string $haystack String to examine.
     * @param string $needle String to find.
     * @return bool Whether $haystack ends with $needle.
     */
    public static function endsWith($haystack, $needle)
    {
        return '' === $needle || strrpos($haystack, $needle) === strlen($haystack) - strlen($needle);
    }

    /**
     * Determine whether one string contains another.
     * @param string $haystack String to examine.
     * @param string $needle String to find.
     * @return bool Whether $haystack contains $needle.
     */
    public static function contains($haystack, $needle)
    {
        return '' === $needle || strpos($haystack, $needle) !== false;
    }
}