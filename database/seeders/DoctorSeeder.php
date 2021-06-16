<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $doctors = [
            [
                'doctor_id' => 'VIP/DR/2021/0001',
                'profile_photo' => '1.jpeg',
                'name' => 'VIParth Goswami',
                'specialist' => 'Developer',
                'mobile_no' => '8000461190',
                'email' => 'mr.parth.developer@gmail.com',
                'address' => 'e-193 tejnravihar, virat nage',
                'city' => 'Ahmedabad',
                'state' => 'Gujrat',
                'pin_code' => '360855',
                'aadhar_no' => '596049913085',
                'document_photo' => '1.jpg',
                'gender' => 'male',
                'dob' => '2000-02-22',
                'status' => 'active',
                'password' => Hash::make('password'),
            ],
            [
                'doctor_id' => 'VIP/DR/2021/0002',
                'profile_photo' => '2.jpeg',
                'name' => 'Parthgiri Goswami',
                'specialist' => 'Developer1',
                'mobile_no' => '8000461190',
                'email' => 'mr.parth.developer@gmail.com1',
                'address' => 'e-193 tejnravihar, virat nage1',
                'city' => 'Gandhinagar',
                'state' => 'Gujrat',
                'pin_code' => '360855',
                'aadhar_no' => '596049913085',
                'document_photo' => '2.jpg',
                'gender' => 'female',
                'dob' => '2000-02-22',
                'status' => 'active',
                'password' => Hash::make('password'),
            ],
            [
                'doctor_id' => 'VIP/DR/2021/0003',
                'profile_photo' => '3.png',
                'name' => 'Parth Goswami',
                'specialist' => 'Developer2',
                'mobile_no' => '8000461190',
                'email' => 'mr.parth.developer@gmail.com2',
                'address' => 'e-193 tejnravihar, virat nage2',
                'city' => 'Surat',
                'state' => 'Gujrat',
                'pin_code' => '360855',
                'aadhar_no' => '596049913085',
                'document_photo' => '3.jpg',
                'gender' => 'male',
                'dob' => '2000-02-22',
                'status' => 'active',
                'password' => Hash::make('password'),
            ],
            [
                'doctor_id' => 'VIP/DR/2021/0004',
                'profile_photo' => '4.png',
                'name' => 'Giri Goswami',
                'specialist' => 'Developer3',
                'mobile_no' => '8000461190',
                'email' => 'mr.parth.developer@gmail.com3',
                'address' => 'e-193 tejnravihar, virat nage3',
                'city' => 'Bhavnagar',
                'state' => 'Gujrat',
                'pin_code' => '360855',
                'aadhar_no' => '596049913085',
                'document_photo' => '4.jpg',
                'gender' => 'female',
                'dob' => '2000-02-22',
                'status' => 'active',
                'password' => Hash::make('password'),
            ],

        ];


        foreach ($doctors as $doctor) {

            $doctorObj = new Doctor();
            $doctorObj->doctor_id = $doctor['doctor_id'];
            $doctorObj->profile_photo = $doctor['profile_photo'];
            $doctorObj->name = $doctor['name'];
            $doctorObj->specialist = $doctor['specialist'];
            $doctorObj->mobile_no = $doctor['mobile_no'];
            $doctorObj->email = $doctor['email'];
            $doctorObj->address = $doctor['address'];
            $doctorObj->city = $doctor['city'];
            $doctorObj->state = $doctor['state'];
            $doctorObj->pin_code = $doctor['pin_code'];
            $doctorObj->aadhar_no = $doctor['aadhar_no'];
            $doctorObj->document_photo = $doctor['document_photo'];
            $doctorObj->gender = $doctor['gender'];
            $doctorObj->dob = $doctor['dob'];
            $doctorObj->status = $doctor['status'];
            $doctorObj->password = $doctor['password'];
            $doctorObj->save();

        }

    }
}
