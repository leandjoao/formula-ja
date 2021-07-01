<?php

namespace Database\Seeders;

use App\Models\User as UserModel;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = ['admin', 'user', 'farmacia'];

        foreach($users as $key=>$value) {
            $user = new UserModel();
            $user->name = $value;
            $user->email = $value . '@' . config('app.domain');
            $user->password = Hash::make($value);
            $user->access_level = $key + 1;
            $user->phone = $faker->phoneNumber;
            $user->save();
        }
    }
}
