<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NutritionEntry;
use Faker\Factory as Faker;

class NutritionEntriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $foodFaker = \Faker\Factory::create();
        $foodFaker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($foodFaker));
        $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++) {
            NutritionEntry::create([
                'food_name' => $foodFaker->foodName(),
                'calories' => $faker->numberBetween(50, 500),
                'protein' => $faker->numberBetween(1, 30),
                'carbohydrates' => $faker->numberBetween(1, 50),
                'fat' => $faker->numberBetween(1, 20),
            ]);
        }
    }
}
