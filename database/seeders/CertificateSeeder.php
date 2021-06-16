<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $certificates = [
            [
                'doc_id' => '1',
                'degree_name' => 'BCA',
                'certificate_name' => 'c1.jpg',
                'certificate_file_path' => '/upload_file/doctor/doctor_certificates/c1.jpg',
            ],
            [
                'doc_id' => '1',
                'degree_name' => 'MCA',
                'certificate_name' => 'c2.jpg',
                'certificate_file_path' => '/upload_file/doctor/doctor_certificates/c2.jpg',
            ],
            [
                'doc_id' => '2',
                'degree_name' => 'BCA',
                'certificate_name' => 'c3.jpg',
                'certificate_file_path' => '/upload_file/doctor/doctor_certificates/c3.jpg',
            ],
            [
                'doc_id' => '2',
                'degree_name' => 'MCA',
                'certificate_name' => 'c4.jpg',
                'certificate_file_path' => '/upload_file/doctor/doctor_certificates/c4.jpg',
            ],
            [
                'doc_id' => '3',
                'degree_name' => 'BCA',
                'certificate_name' => 'c1.jpg',
                'certificate_file_path' => '/upload_file/doctor/doctor_certificates/c1.jpg',
            ],
            [
                'doc_id' => '3',
                'degree_name' => 'MCA',
                'certificate_name' => 'c2.jpg',
                'certificate_file_path' => '/upload_file/doctor/doctor_certificates/c2.jpg',
            ],
            [
                'doc_id' => '4',
                'degree_name' => 'BCA',
                'certificate_name' => 'c3.jpg',
                'certificate_file_path' => '/upload_file/doctor/doctor_certificates/c3.jpg',
            ],
            [
                'doc_id' => '4',
                'degree_name' => 'MCA',
                'certificate_name' => 'c4.jpg',
                'certificate_file_path' => '/upload_file/doctor/doctor_certificates/c4.jpg',
            ],

        ];

        foreach($certificates as $certificate)
        {
            $certificateObj = new Certificate();
            $certificateObj->doc_id = $certificate['doc_id'];
            $certificateObj->degree_name = $certificate['degree_name'];
            $certificateObj->certificate_name = $certificate['certificate_name'];
            $certificateObj->certificate_file_path = $certificate['certificate_file_path'];
            $certificateObj->save();

        }
    }
}
