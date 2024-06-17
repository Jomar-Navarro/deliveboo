<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AddUserToRestaurantTable extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $users = ['LaTrattoria', "OsteriadelChianti", "GlobalBistro", "FusionFlavors", "Dragoned'Oro", "LaGrandeMuraglia", "Sakura", "TokyoGarden", "ElSombrero", "CantinaMariachi", "TajMahal", "BombayPalace", "IlPescatore", "LaBarchetta", "LaGriglia", "SteakHouse", "PizzeriaNapoli", "PizzaRoma",];

        foreach ($users as $user) {
            $new_user = new User();
            $new_user->name = $user;
            $new_user->email = $user . '@gmail.com';
            $new_user->password = Hash::make('restaurant');
            $new_user->save();
            // dump($new_user);
        }
    }
}
