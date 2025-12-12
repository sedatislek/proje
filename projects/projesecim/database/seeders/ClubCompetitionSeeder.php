<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubCompetitionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('club_competitions')->insert([
            [ 'id'=>1, 'club_id'=>1, 'season_id'=>2, 'competition_id'=>1, 'participated'=>1, 'result'=>'Final 5.', 'created_at'=>now(), 'updated_at'=>now() ],
            [ 'id'=>2, 'club_id'=>2, 'season_id'=>2, 'competition_id'=>1, 'participated'=>1, 'result'=>'Yarı Final', 'created_at'=>now(), 'updated_at'=>now() ],
            [ 'id'=>3, 'club_id'=>3, 'season_id'=>2, 'competition_id'=>3, 'participated'=>1, 'result'=>'Bölge 2.', 'created_at'=>now(), 'updated_at'=>now() ],
            [ 'id'=>4, 'club_id'=>4, 'season_id'=>2, 'competition_id'=>3, 'participated'=>0, 'result'=>null, 'created_at'=>now(), 'updated_at'=>now() ],
            [ 'id'=>5, 'club_id'=>5, 'season_id'=>2, 'competition_id'=>2, 'participated'=>1, 'result'=>'Türkiye 4.', 'created_at'=>now(), 'updated_at'=>now() ],
            [ 'id'=>6, 'club_id'=>6, 'season_id'=>2, 'competition_id'=>4, 'participated'=>1, 'result'=>'Final 3.', 'created_at'=>now(), 'updated_at'=>now() ],
        ]);
    }
}
