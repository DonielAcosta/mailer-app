<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\TypeUserSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\UserDataSeeder;
use Database\Seeders\CountriesSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            TypeUserSeeder::class,
            UserSeeder::class,
            UserDataSeeder::class,
            CountriesSeeder::class,
         ]);
    }
}
