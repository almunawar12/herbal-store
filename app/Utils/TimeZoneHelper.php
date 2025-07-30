<?php

namespace App\Utils;

use Carbon\Carbon;

class TimeZoneHelper
{
    const JAKARTA_TIMEZONE = 'Asia/Jakarta';

    /**
     * Get current time in Jakarta timezone
     *
     * @return Carbon
     */
    public static function now()
    {
        return Carbon::now(self::JAKARTA_TIMEZONE);
    }

    /**
     * Convert any datetime to Jakarta timezone
     *
     * @param mixed $datetime
     * @return Carbon
     */
    public static function toJakarta($datetime)
    {
        if (!$datetime) {
            return null;
        }

        if (is_string($datetime)) {
            $datetime = Carbon::parse($datetime);
        }

        return $datetime->setTimezone(self::JAKARTA_TIMEZONE);
    }

    /**
     * Format datetime to Indonesian format with Jakarta timezone
     *
     * @param mixed $datetime
     * @param string $format
     * @return string
     */
    public static function formatJakarta($datetime, $format = 'd/m/Y H:i')
    {
        if (!$datetime) {
            return '';
        }

        return self::toJakarta($datetime)->format($format);
    }

    /**
     * Format datetime to readable Indonesian format
     *
     * @param mixed $datetime
     * @return string
     */
    public static function formatReadable($datetime)
    {
        if (!$datetime) {
            return '';
        }

        return self::toJakarta($datetime)->format('d F Y, H:i') . ' WIB';
    }

    /**
     * Get Jakarta timezone string
     *
     * @return string
     */
    public static function getTimezone()
    {
        return self::JAKARTA_TIMEZONE;
    }

    /**
     * Create Carbon instance from date string in Jakarta timezone
     *
     * @param string $dateString
     * @return Carbon
     */
    public static function parseJakarta($dateString)
    {
        return Carbon::parse($dateString, self::JAKARTA_TIMEZONE);
    }

    /**
     * Get difference in human readable format
     *
     * @param mixed $datetime
     * @return string
     */
    public static function diffForHumans($datetime)
    {
        if (!$datetime) {
            return '';
        }

        return self::toJakarta($datetime)->diffForHumans();
    }
}
