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
        $faker = Faker::create('it_IT'); // Impostiamo Faker per generare dati in italiano
        $dishes = Dish::all();

        // Generiamo ordini per l'ultimo anno
        foreach (range(1, 365) as $index) {
            // Data casuale nell'ultimo anno
            $date = Carbon::now()->subDays($index);

            $order = Order::create([
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'address' => $faker->address,
                'postal_code' => $faker->postcode, // Codice postale italiano
                'phone_number' => '+39 ' . substr($faker->phoneNumber, 1, 10), // Aggiungiamo +39 al numero generato
                'email' => $faker->email,
                'total_price' => $faker->randomFloat(2, 10, 100),
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            // Collegamento dei piatti all'ordine con quantità pivot e timestamp
            $pivotData = $dishes->random(rand(1, 5))->pluck('id')->mapWithKeys(function ($id) use ($date, $faker) {
                return [
                    $id => [
                        'quantity' => rand(1, 3),
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]
                ];
            })->toArray();

            $order->dishes()->attach($pivotData);
        }
    }
}
