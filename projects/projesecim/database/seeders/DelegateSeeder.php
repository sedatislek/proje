<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DelegateSeeder extends Seeder
{
    public function run(): void
    {
        // Temizle
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('delegates')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Örnek delegasyon verileri
        $delegates = [
            [
                'club_id' => 1,
                'season1' => 2025,
                'season2' => 2026,
                'delegate_type' => 'normal',
                'category_id' => 2,
            ],
            [
                'club_id' => 2,
                'season1' => 2025,
                'season2' => 2026,
                'delegate_type' => 'normal',
                'category_id' => 3,
            ],
            [
                'club_id' => 3,
                'season1' => 2026,
                'season2' => 2027,
                'delegate_type' => 'normal',
                'category_id' => 4,
            ],
        ];

        foreach ($delegates as $d) {
            DB::table('delegates')->insert([
                'club_id'     => $d['club_id'],
                'season1'     => $d['season1'],
                'season2'     => $d['season2'],
                'delegate_type' => $d['delegate_type'],
                'category_id' => $d['category_id'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
