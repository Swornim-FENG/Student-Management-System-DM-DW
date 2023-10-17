<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Students;
use Faker\Factory as Faker;
class Studentseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();
        for($i=0;$i<18;$i++){
            $student=new Students;
            $student->Fullname=$faker->name;
            $student->permanent_address=$faker->address;
            $student->temporary_address=$faker->address;
            $student->sem_start_date=$faker->date;
            $student->sem_end_date=$faker->date;
            $student->save();
            
            }
    }
}
