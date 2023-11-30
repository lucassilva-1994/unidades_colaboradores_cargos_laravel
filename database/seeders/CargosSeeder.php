<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CargosSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();
        for($i=0;$i<1000;$i++){
            Cargo::create([
                'cargo' => $faker->unique()->jobTitle(),
                'created_at' => $faker->dateTimeThisYear
            ]);
        }
    }
}
