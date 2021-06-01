<?php


namespace App\Http\Repositories;


use App\Match;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class MatchRepository
 *
 * @package App\Http\Repositories
 */
class MatchRepository extends AbstractRepository implements IRepository
{

    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @return MatchRepository|mixed|null
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     *
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @param int $id
     *
     * @return Builder[]|Collection
     */
    public function get(int $id)
    {
        return Match::query()
            ->where('status', 0)
            ->where('week', $id)
            ->join('teams as t', 't.id', '=', 'matches.host_id')
            ->join('teams as t2', 't2.id', '=', 'matches.away_id')
            ->get(['matches.id', 'matches.host_id', 'matches.away_id', 't.name as hostName', 't2.name as awayName']);
    }
}
