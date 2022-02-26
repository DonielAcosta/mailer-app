<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Countries;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('countries') as $data) {
            $country = new Countries();
            $country->name = $data['fields']['name'];
            switch($country['model']) {
                case 'city':
                    $country->countries_id = $data['fields']['country'];
                    break;
                case 'state':
                    $country->countries_id = $data['fields']['state'];
                    break;
            }
            $country->save();
        }
    }
}
