<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clubs')->insert([
            ['club_id'=>1,'club_name'=>'Konya Cimnastik Spor Kulübü','province'=>'Konya','is_active'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['club_id'=>2,'club_name'=>'Selçuklu Belediyesi Spor Kulübü','province'=>'Konya','is_active'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['club_id'=>3,'club_name'=>'Toroslar Belediyesi Spor Kulübü','province'=>'Mersin','is_active'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['club_id'=>4,'club_name'=>'Mersin Olimpik Cimnastik','province'=>'Mersin','is_active'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['club_id'=>5,'club_name'=>'İstanbul Gençlik ve Spor Kulübü','province'=>'İstanbul','is_active'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['club_id'=>6,'club_name'=>'Beşiktaş Jimnastik Kulübü','province'=>'İstanbul','is_active'=>1,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
