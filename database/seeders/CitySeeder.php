<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cities = [
            [
                'name' => 'Ahmedabad',
                'state_id' => 1
            ],
            [
                'name' => 'Anand',
                'state_id' => 1
            ],
            [
                'name' => 'Anklesvar',
                'state_id' => 1
            ],
            [
                'name' => 'Bharuch (Broach)',
                'state_id' => 1
            ],
            [
                'name' => 'Bhavnagar (Bhaunagar)',
                'state_id' => 1
            ],
            [
                'name' => 'Bhuj',
                'state_id' => 1
            ],
            [
                'name' => 'Dahod [Dohad]',
                'state_id' => 1
            ],
            [
                'name' => 'Gandhidham',
                'state_id' => 1
            ],
            [
                'name' => 'Godhra',
                'state_id' => 1
            ],
            [
                'name' => 'Jamnagar',
                'state_id' => 1
            ],
            [
                'name' => 'Junagadh',
                'state_id' => 1
            ],
            [
                'name' => 'Mahesana',
                'state_id' => 1
            ],
            [
                'name' => 'Morvi',
                'state_id' => 1
            ],
            [
                'name' => 'Nadiad',
                'state_id' => 1
            ],
            [
                'name' => 'Navsari',
                'state_id' => 1
            ],
            [
                'name' => 'Palanpur',
                'state_id' => 1
            ],
            [
                'name' => 'Patan',
                'state_id' => 1
            ],
            [
                'name' => 'Porbandar',
                'state_id' => 1
            ],
            [
                'name' => 'Rajkot',
                'state_id' => 1
            ],
            [
                'name' => 'Surat',
                'state_id' => 1
            ],
            [
                'name' => 'Surendranagar',
                'state_id' => 1
            ],
            [
                'name' => 'Vadodara (Baroda)',
                'state_id' => 1
            ],
            [
                'name' => 'Valsad (Bulsar)',
                'state_id' => 1
            ],
            [
                'name' => 'Vapi (Wapi)',
                'state_id' => 1
            ],
            [
                'name' => 'Veraval',
                'state_id' => 1
            ],
            [
                'name' => 'Other',
                'state_id' => 1
            ],
            [
                'name' => 'Udaipur',
                'state_id' => 2
            ],
            [
                'name' => 'Jesalmar',
                'state_id' => 2
            ],
            [
                'name' => 'Bhopal',
                'state_id' => 3
            ],
            [
                'name' => 'Indore',
                'state_id' => 3
            ],
            [
                'name' => 'Mumbai',
                'state_id' => 4
            ],
            [
                'name' => 'Pune',
                'state_id' => 4
            ],
            [
                'name' => 'Goa',
                'state_id' => 5
            ],
        ];

        foreach($cities as $citie){
            $city = new City();
            $city->name = $citie['name'];;
            $city->state_id = $citie['state_id'];
            $city->save();
        }

    }
}
