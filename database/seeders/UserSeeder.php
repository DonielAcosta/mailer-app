<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $type = new User();
        $type->identificador = '1';
        $type->email = 'comun@gmail.com';
        $type->password ='$2y$10$.92h5j9rSf8FC50upkcQjuehvcCgN.KDcnp136lM.qFtxmk6cB39a';
        $type->save();

        $type = new User();
        $type->identificador = '2';
        $type->email = 'comun1@gmail.com';
        $type->password ='$2y$10$.92h5j9rSf8FC50upkcQjuehvcCgN.KDcnp136lM.qFtxmk6cB39a';
        $type->save();

        $type = new User();
        $type->identificador = '2';
        $type->email = 'comun2@gmail.com';
        $type->password ='$2y$10$.92h5j9rSf8FC50upkcQjuehvcCgN.KDcnp136lM.qFtxmk6cB39a';
        $type->save();

    }
}
