<?php

namespace Epubli\Common\Basic;

use Iterator;
use Exception;

/**
 * Derived from old stack: class Epubli_Tools_Range
 *
 * Stores a set of non-negative integers.
 * Can load from and store to a normalized string representation like "1,5,7-19".
 *
 * The parsing is very simple and tolerant. ',' and '-' are considered separators
 * (hence no negative numbers are allowed). Anything else is evaluated as an integer.
 * Exceptions are only thrown when trying to insert negative numbers.
 *
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
class IntegerSet implements Iterator
{
    /**
     * @var array Container for all items of the set.
     **/
    private $items = array();

    public function __construct($setString = null)
    {
        $this->load($setString);
    }

    /**
     * Initialize from set string representation
     * @param $setString
     * @throws Exception
     */
    public function load($setString)
    {
        $this->items = array();

        if (is_null($setString)) {
            return;
        }

        $ranges = explode(',', $setString);

        foreach ($ranges as $range) {
            $bounds = explode('-', $range, 2);
            switch (count($bounds)) {
                case 1:
                    $this->insert($bounds[0]);
                    break;
                case 2:
                    $this->insertRange($bounds[0], $bounds[1]);
                    break;
            }
        }
    }

    /**
     * @return array All items in the set
     */
    public function getItems()
    {
        return array_values($this->items);
    }

    public function __toString()
    {
        $result = '';
        $prev = null;
        $inRange = false;
        foreach ($this->items as $current) {
            if ($prev === $current - 1) {
                if (!$inRange) {
                    $result .= '-';
                    $inRange = true;
                }
            } else {
                if ($inRange) {
                    $result .= $prev;
                    $inRange = false;
                }
                if (isset($prev)) {
                    $result .= ',';
                }
                $result .= $current;
            }
            $prev = $current;
        }
        if ($inRange) {
            $result .= $prev;
        }
        return $result;
    }

    /**
     * Number of elements
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Insert a number
     * @param int $num
     * @throws Exception when trying to insert negative numbers.
     */
    public function insert($num)
    {
        $num = (int) $num;
        if ($num < 0) {
            throw new Exception('No negative values allowed!');
        }
        if (!$this->contains($num)) {
            $this->items[] = $num;
            sort($this->items);
        }
    }

    /**
     * Insert a range
     * @param int $from
     * @param int $to
     * @throws Exception when trying to insert negative numbers.
     */
    public function insertRange($from, $to)
    {
        $from = (int) $from;
        $to = (int) $to;
        if ($from < 0 || $to < 0) {
            throw new Exception('No negative values allowed!');
        }
        $this->items = array_unique(array_merge($this->items, range($from, $to)));
        sort($this->items);
    }

    /**
     * Remove a number
     * @param int $num
     */
    public function remove($num)
    {
        $num = (int) $num;
        if (($pos = array_search($num, $this->items)) !== false) {
            unset($this->items[$pos]);
        }
    }

    /**
     * Remove a range
     * @param int $from
     * @param int $to
     */
    public function removeRange($from, $to)
    {
        $from = (int) $from;
        $to = (int) $to;
        while ($from <= $to) {
            $this->remove($from);
            ++$from;
        }
    }

    /**
     * Check if a given integer is in the set
     * @param int $element
     * @return bool TRUE if in set
     */
    public function contains($element)
    {
        return in_array($element, $this->items);
    }

    // Iteration interface
    public function current()
    {
        return current($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function next()
    {
        return next($this->items);
    }

    public function valid()
    {
        $key = key($this->items);
        return ($key !== null && $key !== false);
    }

    public function rewind()
    {
        return reset($this->items);
    }

    public function last()
    {
        return end($this->items);
    }
}
