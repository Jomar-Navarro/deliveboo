<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = json_decode(file_get_contents(__DIR__ . '/types.json'));

        foreach ($types as $item) {
            $new_item = new Type();
            $new_item->type_name = $item->type_name;
            $new_item->description = $item->description;

            // dump($new_item);
            $new_item->save();
        }
    }
}
