<?php

namespace Database\Seeders;

use App\Functions\Helper as Help;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = json_decode(file_get_contents(__DIR__ . '/dishes.json'));

        foreach ($dishes as $item) {
            $new_item = new Dish();
            $new_item->dish_name = $item->dish_name;
            $new_item->restaurant_id = Restaurant::inRandomOrder()->first()->id;
            $new_item->description = $item->description;
            $new_item->price = $item->price;
            $new_item->is_visible = $item->is_visible;
            $new_item->image_url = $item->image_url;
            $new_item->save();
        }

    }
}
