<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisciplineSeeder extends Seeder
{
    public function run(): void
    {
        // FK kilidini kapat
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('disciplines')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $disciplines = [
            // Artistik
            ['name' => 'Artistik – Erkek', 'is_olympic' => 1],
            ['name' => 'Artistik – Kadın', 'is_olympic' => 1],

            // Ritmik
            ['name' => 'Ritmik – Kadın', 'is_olympic' => 1], // ritmik erkek yok resmi olarak

            // Trampolin
            ['name' => 'Trampolin – Erkek', 'is_olympic' => 1],
            ['name' => 'Trampolin – Kadın', 'is_olympic' => 1],

            // Aerobik
            ['name' => 'Aerobik – Erkek', 'is_olympic' => 0],
            ['name' => 'Aerobik – Kadın', 'is_olympic' => 0],

            // Parkur
            ['name' => 'Parkur – Erkek', 'is_olympic' => 0],
            ['name' => 'Parkur – Kadın', 'is_olympic' => 0],
        ];

        foreach ($disciplines as $d) {
            DB::table('disciplines')->insert([
                'name'       => $d['name'],
                'is_olympic' => $d['is_olympic'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
