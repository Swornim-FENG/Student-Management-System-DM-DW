<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admins;
use Faker\Factory as Faker;
class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();
        for($i=0;$i<18;$i++){
            $admin=new Admins;
            $admin->Fullname=$faker->name;
            $admin->permanent_address=$faker->address;
            $admin->temporary_address=$faker->address;
            $admin->save();
            
            }
    }
}
