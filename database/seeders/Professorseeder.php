<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Professors;
use Faker\Factory as Faker;
class Professorseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();
        for($i=0;$i<18;$i++){
            $professor=new Professors;
            $professor->Fullname=$faker->name;
            $professor->permanent_address=$faker->address;
            $professor->temporary_address=$faker->address;
            $professor->save();
            
            }
    }
}
