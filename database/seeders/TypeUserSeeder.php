<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeUser;

class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $type = new TypeUser();
        $type->type = 'admin';
        $type->save();

        $type = new TypeUser();
        $type->type = 'client';
        $type->save();

    }
}
