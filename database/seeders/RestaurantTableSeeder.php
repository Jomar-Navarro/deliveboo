<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Functions\Helper as Help;
use App\Models\User;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = json_decode(file_get_contents(__DIR__ . '/restaurants.json'));

        foreach ($restaurants as $item) {
            $new_item = new Restaurant();
            $new_item->user_id = $item->user_id;
            $new_item->name = $item->name;
            $new_item->slug = Help::generateSlug($item->name, Restaurant::class);
            $new_item->description = $item->description;
            $new_item->address = $item->address;
            $new_item->vat_number = $item->vat_number;
            $new_item->image = $item->image;

            // dd($new_item);
            $new_item->save();
        }
    }
}
