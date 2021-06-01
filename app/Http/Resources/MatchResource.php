<?php


namespace App\Http\Resources;


use App\Http\Helpers\PointHelper;
use App\Http\Repositories\MatchRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class MatchResource
 *
 * @package App\Http\Resources
 */
class MatchResource extends AbstractResource
{
    /**
     * @var null
     */
    private static $instance = null;
    /**
     * @var int
     */
    private $hostPoint = 1;

    /**
     * @return MatchResource|null
     */
    public static function getInstance(): ?MatchResource
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param int $week
     *
     * @return Builder[]|Collection
     */
    public function getMatches(int $week)
    {
        return MatchRepository::getInstance()->get($week);
    }

    /**
     * @param int $week
     *
     * @return array
     */
    public function playMatch(int $week): array
    {
        $result = [];
        $matchesOfWeek = MatchRepository::getInstance()->get($week);
        foreach ($matchesOfWeek as $key => $match) {
            $host = $match->getTeam($match->host_id);
            $away = $match->getTeam($match->away_id);

            $hostPoint = PointHelper::getPoint($host);
            $hostPoint += $this->hostPoint;

            $awayPoint = PointHelper::getPoint($away);

            if ($hostPoint > $awayPoint) {
                $hostGoal = intval(($hostPoint * 100 / ($hostPoint + $awayPoint))/20);
                $awayGoal = intval(($awayPoint * 100 / ($hostPoint + $awayPoint))/20);
                $this->updateTeam($match->host_id, $hostGoal, $awayGoal, $match->away_id);
            } else {
                $hostGoal = intval(($hostPoint * 100 / ($hostPoint + $awayPoint))/20);
                $awayGoal = intval(($awayPoint * 100 / ($hostPoint + $awayPoint))/20);
                $this->updateTeam($match->away_id, $awayGoal, $hostGoal, $match->host_id);
            }

            $match->host_goal = $hostGoal;
            $match->away_goal = $awayGoal;
            $match->status = 1;
            $match->save();

            $result[$key] = ['hostGoal' => $hostGoal, 'awayGoal' => $awayGoal];
        }
        return $result;

    }

    /**
     * @param int $teamId
     * @param int $goal
     * @param int $awayGoal
     * @param int $awayId
     */
    private function updateTeam(int $teamId, int $goal, int $awayGoal, int $awayId)
    {
        $team = TeamResource::getInstance()->getTeam($teamId);
        $away = TeamResource::getInstance()->getTeam($awayId);
        if ($goal > $awayGoal) {
            $team->pts_point += 3;
            $team->wins += 1;
        } elseif ($goal == $awayGoal) {
            $team->pts_point += 1;
            $team->draws += 1;
        } else {
            $team->losses += 1;
        }
        $team->matches += 1;
        $away->matches += 1;
        $team->goal_difference += ($goal - $awayGoal);
        $away->goal_difference += ($awayGoal - $goal);
        $team->save();
        $away->save();
    }
}
