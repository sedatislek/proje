<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // FK kontrolünü kapat
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            ['name' => 'Minikler'],
            ['name' => 'Küçükler'],
            ['name' => 'Yıldızlar'],
            ['name' => 'Gençler'],
            ['name' => 'Büyükler'],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->insert([
                'name'       => $cat['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
