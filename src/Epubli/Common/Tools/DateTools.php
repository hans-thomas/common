<?php

namespace Epubli\Common\Tools;

/**
 * Tools for date(time) manipulation and visualization.
 * @author Timor Kodal <t.kodal@epubli.com>
 * @author Simon Schrape <simon@epubli.com>
 */
class DateTools
{
    public static function validateDate($date)
    {
        if ($date instanceof \DateTime) {
            return true;
        } else if (is_string($date)) {
            preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/is',$date,$m);
            return !empty($m);
        }
        return false;
    }
    /**
     * adds or subtracts a time span to or from a given date
     * syntax example (subtract 1 year, 2 months, 10 days, 5 hours, 50 minutes and 30 seconds from the current datetime):
     * DateTools::dateAdd('-1y2m10dT5h50m30s');
     *
     * @param $period
     * @param \DateTime|int|null $date
     * @return \DateTime|int
     */
    public static function dateAdd($period, $date = null)
    {
        if (!isset($date)) {
            /**
             * @var \DateTime
             */
            $date = new \DateTime();
        }

        if (is_numeric($period)) {
            $date = new \DateTime();
            $date->setTimestamp($date->getTimestamp() + $period);
        } else if ($period instanceof \DateTime) {
            return $period;
        } else if (isset($period) && $period) {
            $codeInterval = 'P' . str_replace(['+', '-'], '', strtoupper($period));
            $interval = new \DateInterval($codeInterval);
            if ($period{0} == "-") {
                $date->sub($interval);
            } else {
                $date->add($interval);
            }
        }

        return $date;
    }

}