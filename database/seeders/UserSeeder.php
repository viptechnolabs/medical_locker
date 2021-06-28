<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            [
                'name' => 'VIParth Goswami',
                'mobile_no' => '8000461190',
                'email' => 'mr.parth.developer@gmail.com',
                'address' => 'e-193 tejnravihar, virat nage',
                'city' => 'Ahmedabad',
                'state' => 'Gujrat',
                'pin_code' => '360855',
                'aadhar_no' => '596049913085',
                'gender' => 'male',
                'dob' => '2000-02-22',
                'status' => 'active',
                'profile_photo' => '1.png',
                'document_photo' => '1.jpg',
                'password' => Hash::make('password'),
            ],
            [

                'name' => 'Parthgiri Goswami',
                'mobile_no' => '8000461190',
                'email' => 'mr.parth.developer@gmail.com1',
                'address' => 'e-193 tejnravihar, virat nage1',
                'city' => 'Gandhidham',
                'state' => 'Gujrat',
                'pin_code' => '360855',
                'aadhar_no' => '596049913085',
                'gender' => 'female',
                'dob' => '2000-02-22',
                'status' => 'active',
                'profile_photo' => '2.jpeg',
                'document_photo' => '2.jpg',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Parth Goswami',
                'mobile_no' => '8000461190',
                'email' => 'mr.parth.developer@gmail.com2',
                'address' => 'e-193 tejnravihar, virat nage2',
                'city' => 'Surat',
                'state' => 'Gujrat',
                'pin_code' => '360855',
                'aadhar_no' => '596049913085',
                'gender' => 'male',
                'dob' => '2000-02-22',
                'status' => 'active',
                'profile_photo' => '3.jpeg',
                'document_photo' => '3.jpg',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Giri Goswami',
                'mobile_no' => '8000461190',
                'email' => 'mr.parth.developer@gmail.com3',
                'address' => 'e-193 tejnravihar, virat nage3',
                'city' => 'Bhavnagar (Bhaunagar)',
                'state' => 'Gujrat',
                'pin_code' => '360855',
                'aadhar_no' => '596049913085',
                'gender' => 'female',
                'dob' => '2000-02-22',
                'status' => 'active',
                'profile_photo' => '4.png',
                'document_photo' => '4.jpg',
                'password' => Hash::make('password'),
            ],

        ];

        foreach ($users as $user) {

            $userObj = new User();
            $userObj->name = $user['name'];
            $userObj->mobile_no = $user['mobile_no'];
            $userObj->email = $user['email'];
            $userObj->address = $user['address'];
            $userObj->city = $user['city'];
            $userObj->state = $user['state'];
            $userObj->pin_code = $user['pin_code'];
            $userObj->aadhar_no = $user['aadhar_no'];
            $userObj->gender = $user['gender'];
            $userObj->dob = $user['dob'];
            $userObj->status = $user['status'];
            $userObj->profile_photo = $user['profile_photo'];
            $userObj->document_photo = $user['document_photo'];
            $userObj->password = $user['password'];
            $userObj->save();

        }
    }
}
