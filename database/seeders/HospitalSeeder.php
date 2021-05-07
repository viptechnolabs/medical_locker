<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hospital;
use Illuminate\Support\Facades\Hash;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $hospital = Hospital::create([
            'name' => 'VIP Hospital',
            'logo' => 'vip.jfif',
            'details' => 'Hospital Details',
            'register_no' => '1234',
            'email' => 'viphospital@gmail.com',
            'mobile_no' => '0123456789',
            'fex_no' => '0123456789',
            'address' => 'Dummy Address',
            'pin_cord_no' => '01234',
            'password' => Hash::make('password'),
        ]);
    }
}
