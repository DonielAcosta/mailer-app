<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserData;
use Faker\Factory as Faker;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

    	$type = new UserData();
        $type->users_id = 1;
        $type->name = $faker->name();
        $type->identification = $faker->randomNumber(8, true);
        $type->date_of_birth = $faker->date($format = 'Y-m-d', $max = 'now');
        $type->phone = $faker->e164PhoneNumber(15);
        $type->code_city = 'Merida';
        $type->save();
        
        $type = new UserData();
        $type->users_id = 1;
        $type->name = $faker->name();
        $type->identification = $faker->randomNumber(8, true);
        $type->date_of_birth = $faker->date($format = 'Y-m-d', $max = 'now');
        $type->phone = $faker->e164PhoneNumber(15);
        $type->code_city = 'Falcon';
        $type->save();

        $type = new UserData();
        $type->users_id = 1;
        $type->name = $faker->name();
        $type->identification = $faker->randomNumber(8, true);
        $type->date_of_birth = $faker->date($format = 'Y-m-d', $max = 'now');
        $type->phone = $faker->e164PhoneNumber(15);
        $type->code_city = 'Carabobo';
        $type->save();
    }
}
