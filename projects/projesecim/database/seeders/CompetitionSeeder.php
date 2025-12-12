<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('competitions')->insert([
            [ 'competition_id'=>1, 'name'=>'2025 Artistik Erkek Türkiye Şampiyonası', 'season_id'=>2, 'discipline_id'=>1, 'category_id'=>5, 'competition_type'=>'championship', 'is_team_event'=>1, 'created_at'=>now(),'updated_at'=>now() ],
            [ 'competition_id'=>2, 'name'=>'2025 Artistik Kadın Yıldızlar Türkiye Kupası', 'season_id'=>2, 'discipline_id'=>2, 'category_id'=>3, 'competition_type'=>'cup', 'is_team_event'=>0, 'created_at'=>now(),'updated_at'=>now() ],
            [ 'competition_id'=>3, 'name'=>'2025 Trampolin Küçükler Bölge Şampiyonası', 'season_id'=>2, 'discipline_id'=>4, 'category_id'=>2, 'competition_type'=>'official_regional', 'is_team_event'=>0, 'created_at'=>now(),'updated_at'=>now() ],
            [ 'competition_id'=>4, 'name'=>'2025 Ritmik Gençler Türkiye Şampiyonası', 'season_id'=>2, 'discipline_id'=>3, 'category_id'=>4, 'competition_type'=>'championship', 'is_team_event'=>1, 'created_at'=>now(),'updated_at'=>now() ],
        ]);
    }
}
