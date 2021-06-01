<?php


namespace App\Http\Helpers;


use App\Team;

/**
 * Class PointHelper
 *
 * @package App\Http\Helpers
 */
class PointHelper
{

    /**
     * @var int
     */
    private static $maxGoal = 5;

    /**
     * @param $host
     *
     * @return float|int
     */
    public static function getPoint(Team $host)
    {
        $point = 0;
        if ($host->matches > 0) {
            $point = ($host->pts_point + $host->draws - $host->losses) / $host->matches;
        }

        return $point;
    }

    /**
     * @param int $hostPoint
     * @param int $awayPoint
     *
     * @return false|float|int
     */
    public static function getGoal(int $hostPoint, int $awayPoint)
    {
        $goal = ceil(($hostPoint - $awayPoint) * self::$maxGoal / 100);
        if ($goal < 0) {
            $goal *= -1;
        }
        return $goal;
    }

}
