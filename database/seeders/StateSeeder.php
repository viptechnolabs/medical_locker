<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $states = [
            'Gujrat',
            'Rajsthan',
            'MP',
            'Goa',
            'Other',
        ];

        foreach($states as $state){
            $states = new State();
            $states->name = $state;
            $states->save();
        }
    }
}
