<?php

use App\Http\Resources\TeamResource;
use App\Match;
use App\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Matches extends Seeder
{
    /**
     * @var array
     */
    private $result;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->result = [];
        Match::query()->delete();
        $teams = TeamResource::getInstance()->getTeams()[0]->toArray();
        $teamIdList = array_column($teams, 'id');
        foreach ($teamIdList as $teamId){

            $cloneTeamIdList = $teamIdList;
            unset($cloneTeamIdList[array_search($teamId, $cloneTeamIdList)]);
            $cloneTeamIdList = array_values($cloneTeamIdList);

            for($i = 1; $i <=3; $i++) {

                $item = $this->search($this->result, $i, $teamId);
                if ($item == false){
                    $this->result[$i][$teamId][] = $this->getTeamId($cloneTeamIdList, $i);
                }
            }
        }

        foreach ($this->result as $week => $results){
            foreach ($results as $key => $result){
                foreach ($result as $item){
                    DB::table("matches")->insert([
                        'host_id' => $key,
                        'away_id' => $item,
                        'week' => $week,
                        'status' => 0
                    ]);
                }
            }
        }

        $matches = Match::all();

        foreach ($matches as $match){
            DB::table("matches")->insert([
                'host_id' => $match->away_id,
                'away_id' => $match->host_id,
                'week' => $match->week + count($teamIdList) - 1,
                'status' => 0
            ]);
        }

//        for ($week = 1; $week <= 6; $week++) {
//            foreach ($teamIdList as $teamId) {
//                unset($teamIdList[array_search($teamId, $teamIdList)]);
//                $teamIdList = array_values($teamIdList);
//                $cloneTeamIdList = $teamIdList;
//                $this->createWeekMatch($teamId, $cloneTeamIdList, $week);
//            }
//        }

    }

    private function getTeamId(array &$cloneTeamIdList, $i)
    {
        $list = $cloneTeamIdList;

        if (isset($this->result[$i])) {
            foreach ($this->result[$i] as $key => $result) {
                unset($list[array_search($key, $list)]);
                foreach ($result as $item) {
                    unset($list[array_search($item, $list)]);
                }
            }
        }

        $list = array_values($list);
        $id = $list[rand(0, count($list)-1)];
        unset($list[array_search($id, $list)]);
        unset($cloneTeamIdList[array_search($id, $cloneTeamIdList)]);
        $cloneTeamIdList = array_values($cloneTeamIdList);
        return $id;
    }

    private function createWeekMatch(int $teamId, array &$cloneTeamIdList, int $week)
    {
        $awayId = $this->getTeamId($cloneTeamIdList, 0);

        DB::table("matches")->insert([
            'host_id' => $teamId,
            'away_id' => $awayId,
            'week' => $week,
            'status' => 0
        ]);
    }

    private function search($result, $i, $teamId)
    {
        if (!isset($result[$i])){
            return false;
        }
        foreach ($result[$i] as $items){
            foreach ($items as $item){
                if ($item == $teamId){
                    return true;
                }
            }
        }
        return false;
    }
}
