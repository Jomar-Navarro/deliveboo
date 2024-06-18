<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class RestaurantTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {

            $restaurant = Restaurant::inRandomOrder()->first();


            $type_id = Type::inRandomOrder()->first()->id;


            $restaurant->types()->attach($type_id);

            // if (!$restaurant->types()->where('type_id', $type_id)->exists()) {
            //     $restaurant->types()->attach($type_id);
            // }
        }
    }
}
