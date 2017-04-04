<?php
/**
 * @author Timor Kodal <t.kodal@epubli.com>
 */
class ArrayTools {

    const SORT_ASC      = 0;
    const SORT_DEFAULT  = 0;
    const SORT_DESC     = 1;
    const SORT_NOCASE   = 2;
    const SORT_TRIM     = 4;
    const SORT_NATURAL  = 8;

    public static $sortKey;
    public static $sortOptions;

    /**
     * private grouping-method called by groupByKeys()
     *
     * @param array $source
     * @param array &$target
     * @param array &$keys
     * @param boolean $deep
     * @return int
     */

    private static function recursive($source, &$target, &$keys, $deep = false) {
        $group = array_pop($keys);
        if ($group) {
            self::recursive($source,$target[$source[$group]],$keys,$deep);
        } else {
            if ($deep) {
                $target[]=$source;
            } else {
                $target=$source;
            }
        }
    }
    /**
     * Uses a given string ($groupKeys) to group an array ($arr)
     *
     * @param array $arr
     * @param string|array $groupKeys
     * @param boolean $deep
     * @return array
     */
    public static function groupByKeys($arr, $groupKeys, $deep = false) {
        $out = Array();
        if (is_array($groupKeys)) {
            foreach($arr as $k=>$v) {
                $grp = array_reverse($groupKeys);
                self::recursive($v,$out,$grp,$deep);
            }
        } else {
            foreach($arr as $k=>$v) {
                if ($deep) {
                    $out[$v[$groupKeys]][]=$v;
                } else {
                    $out[$v[$groupKeys]]=$v;
                }
            }
        }
        return $out;
    }
    /**
     * private comparison-method using sortKey and self::$sortOptions
     *
     * @param array $a
     * @param array $b
     * @return int
     */
    private static function sorter($a, $b) {
        if (!array_key_exists(self::$sortKey,$a) || !array_key_exists(self::$sortKey,$b))
            return 0;
        $a = $a[self::$sortKey];
        $b = $b[self::$sortKey];
        self::transform($a,$b,self::$sortOptions);
        if (self::$sortOptions & self::SORT_NATURAL)
            return (strnatcmp($a,$b));
        else
            return ($a == $b) ? 0 : ($a < $b) ? -1:1;
    }

    /**
     * transforming-method to prepare values to be sorted according to given $sortOptions
     *
     * @param array $a
     * @param array $b
     * @param int $options
     * @return void
     */
    public static function transform(&$a,&$b,$options = self::SORT_DEFAULT) {
        if ($options == self::SORT_DEFAULT)
            return;
        if ($options & self::SORT_NOCASE) {
            $a = strtolower($a);
            $b = strtolower($b);
        }
        if ($options & self::SORT_TRIM) {
            $a = trim($a);
            $b = trim($b);
        }
        if ($options & self::SORT_DESC) {
            $buf = $b;
            $b = $a;
            $a = $buf;
        }
    }

    /**
     * sets all keys to a given default-value or removes them from array if empty
     * @param array $data
     * @param array $keys defines which keys shall be treated
     * @return array
     */

    public static function setEmptyValues(array $data, array $keys = null) {
        foreach ($data as $column=>$value) {
            if (empty($value)) {
                if (!isset($keys)) {
                    unset($data[$column]);
                } else if (in_array($column,$keys)) {
                    unset($data[$column]);
                } else if (array_key_exists($column,$keys)) {
                    $data[$column] = $keys[$column];
                }
            }
        }
        return $data;
    }

    /**
     * perform a batched regExp - match on all elements of an array
     *
     * @param array $array
     * @param string $regExpPattern
     * @return array
     */
    public static function regExpMatches(array $array, $regExpPattern) {
        $results = Array();
        foreach($array as $entry) {
            preg_match($regExpPattern,$entry,$m);
            if (array_key_exists(0,$m)) {
                $results[] = $m;
            }
        }
        return $results;
    }

    /**
     *
     * @param string $target
     * @param array $scope
     * @param int $amount
     * @param int $threshold
     * @return array
     */

    public static function matchText( $needle, array $haystack, $amount=1, $threshold=50 ) {

        $best = 0;
        $matches = array();

        /*  replace underscores, dashes, tabs and linefeeds with whitechars, remove consequent whitechars */
        $needle = strtolower(trim(preg_replace('/[ \-\t\n\r]+/',' ',$needle)));

        foreach($haystack as $key=>$value)
        {
            // match value with target
            similar_text( $needle, strtolower(trim(preg_replace('/[ \-\t\n\r]+/',' ',$value))), $percent);

            // only consider value, if result is better than actual best result and above threshold
            if ($percent >= $best && $percent >= $threshold ) {

                // update actual best result
                $best = $percent;

                // push match on top of matches-array
                array_unshift(
                    &$matches,
                    Array (
                        "key"=>$key,
                        "value"=>$value,
                        "result"=>round($percent,2)
                    )
                );
            }
        }
        if ($amount == 1) {
            return current($matches);
        }

        // return requested amount of matches
        return array_slice( $matches, 0, $amount );
    }

    /**
     * Use a given array-key to sort an array ($array)
     * Attention: this method uses an anonymous function and needs php-version >= 5.3
     *
     * @param array &$array
     * @param string|array $sortKey
     * @param int $sortOptions
     * @return array
     */
   public static function sortByKey(&$array, $sortKey, $sortOptions = self::SORT_ASC) {
     usort($array, function($cmp_a, $cmp_b) use ($sortKey,$sortOptions) {
       if (!array_key_exists($sortKey,$cmp_a) || !array_key_exists($sortKey,$cmp_b))
           return 0;
       $a = $cmp_a[$sortKey];
       $b = $cmp_b[$sortKey];
       self::transform($a,$b,$sortOptions);
       return ($sortOptions & self::SORT_NATURAL)?(strnatcmp($a,$b)):(($a == $b) ? 0 : ($a < $b) ? -1:1);
     });
     return $array;
   }

}