<?php

namespace App\Http\Controllers;

use App\Http\Resources\MatchResource;
use App\Http\Resources\TeamResource;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return array
     */
    public function index(): array
    {
        $teams = TeamResource::getInstance()->getTeams();
        return $this->json($teams);
    }

    /**
     * @param int $week
     *
     * @return array
     */
    public function weekMatches(int $week): array
    {
        $matches = MatchResource::getInstance()->getMatches($week);
        return $this->json($matches->toArray());
    }


    /**
     * @param int $week
     *
     * @return array
     */
    public function playMatch(int $week): array
    {
        $matches = MatchResource::getInstance()->playMatch($week);
        return $this->json($matches);
    }
}
