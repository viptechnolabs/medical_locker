<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

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
        $this->call(HospitalSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(CertificateSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
    }
}
