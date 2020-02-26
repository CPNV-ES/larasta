<?php
namespace App\Services;
class DurationHelper
{
    static function getHoursMinutes($timeInHours)
    {
        //returns an array containing hours and minutes
        $remain = fmod($timeInHours, 1);
        $hours = $timeInHours - $remain;
        $minutes = $remain * 60;
        return array($hours, $minutes);
    }
    static function getPrettyTime($timeInHours)
    {
        if (!$timeInHours) {
            return "0m";
        }
        list($hours, $minutes) = self::getHoursMinutes($timeInHours);
        return ($hours ? $hours . "h" : "") . ($minutes ? $minutes . "m" : "");
    }
}
