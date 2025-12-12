<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SeasonSeeder::class,
            DisciplineSeeder::class,
            CategorySeeder::class,
            ClubSeeder::class,
            DelegateSeeder::class,
            CompetitionSeeder::class,
            ClubCompetitionSeeder::class,
        ]);

        User::updateOrCreate(
            ['email'=>'admin@projesecim.com'],
            ['name'=>'Federasyon Admin','password'=>bcrypt('1234'),'is_admin'=>true]
        );
    }
}
