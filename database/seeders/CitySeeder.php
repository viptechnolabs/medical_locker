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
            'Ahmedabad',
            'Anand',
            'Anklesvar',
            'Bharuch (Broach)',
            'Bharuch (Broach)',
            'Bhavnagar (Bhaunagar)',
            'Bhuj',
            'Dahod [Dohad]',
            'Dahod [Dohad]',
            'Gandhidham',
            'Godhra',
            'Jamnagar',
            'Junagadh',
            'Mahesana',
            'Morvi',
            'Nadiad',
            'Navsari',
            'Palanpur',
            'Patan',
            'Porbandar',
            'Rajkot',
            'Surat',
            'Surendranagar',
            'Vadodara (Baroda)',
            'Valsad (Bulsar)',
            'Vapi (Wapi)',
            'Veraval',
            'Other',
            'Udaipur',
            'Jesalmar',
            'Goa',
        ];

        foreach($cities as $citie){
            $city = new City();
            $city->name = $citie;
            $city->state_id = 1;
            $city->save();
        }

    }
}
