<?php


namespace App\Http\Repositories;


use App\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamRepository
 *
 * @package App\Http\Repositories
 */
class TeamRepository extends AbstractRepository implements IRepository
{
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @return Team[]|Collection
     */
    public function getAll()
    {
        return Team::all();
    }

    /**
     * @param int $id
     *
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function get(int $id)
    {
        return Team::query()->find($id);
    }

    /**
     * @return TeamRepository|null
     */
    public static function getInstance(): ?TeamRepository
    {
        if (self::$instance == null){
            self::$instance = new self();
        }

        return self::$instance;
    }
}
