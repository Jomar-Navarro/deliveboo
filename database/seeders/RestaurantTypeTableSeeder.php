<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Facades\DB;

class RestaurantTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for ($i = 0; $i < 50; $i++) {

        //     $restaurant = Restaurant::inRandomOrder()->first();


        //     $type_id = Type::inRandomOrder()->first()->id;


        //     $restaurant->types()->attach($type_id);

        $restaurantTypes = [
            ['restaurant_id' => 1, 'type_id' => 1],
            ['restaurant_id' => 1, 'type_id' => 9],
            ['restaurant_id' => 1, 'type_id' => 8],
            ['restaurant_id' => 1, 'type_id' => 7],
            ['restaurant_id' => 2, 'type_id' => 1],
            ['restaurant_id' => 2, 'type_id' => 8],
            ['restaurant_id' => 3, 'type_id' => 2],
            ['restaurant_id' => 3, 'type_id' => 1],
            ['restaurant_id' => 3, 'type_id' => 5],
            ['restaurant_id' => 3, 'type_id' => 6],
            ['restaurant_id' => 3, 'type_id' => 7],
            ['restaurant_id' => 3, 'type_id' => 9],
            ['restaurant_id' => 3, 'type_id' => 3],
            ['restaurant_id' => 4, 'type_id' => 2],
            ['restaurant_id' => 4, 'type_id' => 3],
            ['restaurant_id' => 4, 'type_id' => 4],
            ['restaurant_id' => 4, 'type_id' => 5],
            ['restaurant_id' => 4, 'type_id' => 6],
            ['restaurant_id' => 4, 'type_id' => 9],
            ['restaurant_id' => 5, 'type_id' => 3],
            ['restaurant_id' => 5, 'type_id' => 2],
            ['restaurant_id' => 5, 'type_id' => 8],
            ['restaurant_id' => 5, 'type_id' => 7],
            ['restaurant_id' => 6, 'type_id' => 3],
            ['restaurant_id' => 6, 'type_id' => 7],
            ['restaurant_id' => 6, 'type_id' => 8],
            ['restaurant_id' => 7, 'type_id' => 4],
            ['restaurant_id' => 7, 'type_id' => 7],
            ['restaurant_id' => 7, 'type_id' => 8],
            ['restaurant_id' => 8, 'type_id' => 4],
            ['restaurant_id' => 8, 'type_id' => 7],
            ['restaurant_id' => 9, 'type_id' => 5],
            ['restaurant_id' => 9, 'type_id' => 8],
            ['restaurant_id' => 10, 'type_id' => 5],
            ['restaurant_id' => 10, 'type_id' => 8],
            ['restaurant_id' => 11, 'type_id' => 6],
            ['restaurant_id' => 11, 'type_id' => 8],
            ['restaurant_id' => 12, 'type_id' => 6],
            ['restaurant_id' => 12, 'type_id' => 8],
            ['restaurant_id' => 13, 'type_id' => 7],
            ['restaurant_id' => 13, 'type_id' => 1],
            ['restaurant_id' => 14, 'type_id' => 7],
            ['restaurant_id' => 14, 'type_id' => 1],
            ['restaurant_id' => 15, 'type_id' => 8],
            ['restaurant_id' => 15, 'type_id' => 1],
            ['restaurant_id' => 16, 'type_id' => 8],
            ['restaurant_id' => 16, 'type_id' => 1],
            ['restaurant_id' => 17, 'type_id' => 9],
            ['restaurant_id' => 17, 'type_id' => 1],
            ['restaurant_id' => 18, 'type_id' => 9],
            ['restaurant_id' => 18, 'type_id' => 1],
        ];

        DB::table('restaurant_type')->insert($restaurantTypes);
    }
}
