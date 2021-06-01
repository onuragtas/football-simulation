<?php

use App\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Teams extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::query()->delete();

        DB::table('teams')->insert([
            'name' => 'Chelsea'
        ]);

        DB::table('teams')->insert([
            'name' => 'Arsenal'
        ]);

        DB::table('teams')->insert([
            'name' => 'Manchester City'
        ]);

        DB::table('teams')->insert([
            'name' => 'Liverpool'
        ]);
    }
}
