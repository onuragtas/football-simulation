<?php


namespace App\Http\Resources;


use App\Http\Helpers\PointHelper;
use App\Http\Repositories\TeamRepository;
use App\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamResource
 *
 * @package App\Http\Resources
 */
class TeamResource extends AbstractResource
{
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @return array
     */
    public function getTeams(): array
    {
        $teams = TeamRepository::getInstance()->getAll();
        foreach ($teams as &$team){
            $team->point = PointHelper::getPoint($team);
            if ($team->goal_difference > 0) {
                $team->point += $team->goal_difference / 100;
            }
        }
        $totalPoint = array_sum(array_column($teams->toArray(), 'point'));
        return [$teams, $totalPoint];
    }

    /**
     * @param int $id
     *
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getTeam(int $id){
        return TeamRepository::getInstance()->get($id);
    }

    /**
     * @return TeamResource|null
     */
    public static function getInstance(): ?TeamResource
    {
        if (self::$instance == null){
            self::$instance = new self();
        }

        return self::$instance;
    }
}
