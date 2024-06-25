<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Dish;
use Carbon\Carbon;
use Faker\Factory as Faker;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $dishes = Dish::all();

        // Generate orders for the past year
        foreach (range(1, 365) as $index) {
            // Random date in the past year
            $date = Carbon::now()->subDays($index);

            $order = Order::create([
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'address' => $faker->address,
                'postal_code' => $faker->numerify('#####'), // Ensure 5 characters for postal code
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->email,
                'total_price' => $faker->randomFloat(2, 10, 100),
                'created_at' => $date,
                'updated_at' => $date,

            ]);

            // Attach dishes to order with pivot quantity and timestamps
            $pivotData = $dishes->random(rand(1, 5))->pluck('id')->mapWithKeys(function ($id) use ($date) {
                return [
                    $id => [
                        'quantity' => rand(1, 3),
                        'created_at' => $date,
                        'updated_at' => $date
                    ]
                ];
            })->toArray();

            $order->dishes()->attach($pivotData);
        }
    }
}
