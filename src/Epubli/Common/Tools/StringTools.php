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
     * Returns a human readable representation of elapsed time durations
     * @param $value
     * @param int $digits
     * @param bool $fullName
     * @return string
     */
    public static function humanReadableSeconds($value, $digits = 2, $fullName = false) {
        $dimensions = [
            "factor"=>[60,60,60,24,7,4],
            "short"=>["s","m","h","d","w","m"],
            "long"=>["Seconds","Minutes","Hours","Days","Weeks","Months"]
        ];
        $dim = 0;
        $buf = $value;
        while($buf > $factor = $dimensions["factor"][$dim]) {
            $dim ++;
            $buf = $buf / $factor;
        }
        return sprintf("%02.{$digits}f", $buf)." ".$dimensions[($fullName ? 'long':'short')][$dim];
    }

    /**
     * Returns a human readable representation of bytes (filesizes, memory etc)
     * @param $value
     * @param int $digits
     * @param bool $fullName
     * @return string
     */
    public static function humanReadableBytes($value, $digits = 2, $fullName = false) {
        $dimensions = [
            "short"=>["B","KB","MB","GB","TB","PB"],
            "long"=>["Bytes","Kilobyte","Megabyte","Terabyte","Pentabyte"]
        ];
        $factor = 1024;
        $dim = 0;
        $buf = $value;
        while($buf > $factor) {
            $dim ++;
            $buf = $buf / $factor;
        }
        return sprintf("%02.{$digits}f", $buf)." ".$dimensions[($fullName ? 'long':'short')][$dim];
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