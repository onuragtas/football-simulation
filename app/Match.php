<?php

namespace App;

use App\Http\Resources\TeamResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'matches';

    /**
     * @param int $id
     *
     * @return Team[]|Collection
     */
    public function getTeam(int $id){
        return TeamResource::getInstance()->getTeam($id);
    }
}
