<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();
        
            $user=new User;
            $user->Fullname=$faker->name;
            $user->email=$faker->email;
            $user->password=$faker->password;
            $user->role_id=1;
            $user->save();
            
            
    }
}
