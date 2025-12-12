<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeeder extends Seeder
{
    public function run(): void
    {
        // Foreign key kontrolünü kapat
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Tabloyu temizle
        DB::table('seasons')->truncate();

        // Foreign key kontrolünü aç
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Yeni veriler
        DB::table('seasons')->insert([
            ['season_year' => 2024, 'created_at'=>now(), 'updated_at'=>now()],
            ['season_year' => 2025, 'created_at'=>now(), 'updated_at'=>now()],
            ['season_year' => 2026, 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}
