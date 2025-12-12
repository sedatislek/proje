<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discipline;
use App\Models\Season;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // Seasons: 2025, 2026, 2027 (2028 seçim yılı olduğu için sezon olarak kayıt olabilir ama seçim hesaplarında kullanılmaz)
        foreach ([2025,2026,2027] as $year) {
            Season::updateOrCreate(['season_year'=>$year], ['start_date'=>null,'end_date'=>null]);
        }

        // Branches
        Discipline::updateOrCreate(['name'=>'Artistik'], ['is_olympic' => true]);
        Discipline::updateOrCreate(['name'=>'Ritmik'], ['is_olympic' => true]);
        Discipline::updateOrCreate(['name'=>'Trampolin'], ['is_olympic' => true]);
        Discipline::updateOrCreate(['name'=>'Aerobik'], ['is_olympic' => false]);
        Discipline::updateOrCreate(['name'=>'Parkur'], ['is_olympic' => false]);

        // Categories
        foreach (['Minikler','Küçükler','Yıldızlar','Gençler','Büyükler'] as $cat) {
            Category::updateOrCreate(['name'=>$cat]);
        }
    }
}
