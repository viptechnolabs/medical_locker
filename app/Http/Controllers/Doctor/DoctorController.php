<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\City;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    //
    public function index()
    {
        $hospital = Hospital::all();
        return view('doctor.index', ['hospital' => $hospital]);
    }

    public function addDoctor()
    {
        $hospital = Hospital::all();
        $state = State::all();
        $city = City::all();
        return view('doctor.add_doctor', ['hospital' => $hospital, 'states' => $state, 'cities' => $city]);

        //$data = Item::withTrashed()->get();
    }

    public function submitDoctor(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'degree' => 'required',
            'specialist' => 'required|max:13',
            'email' => 'required|max:25|min:7',
            'mobile_no' => 'required|max:13|min:7',
            'state' => 'required',
            'city' => 'required',
            'pin_code' => 'required|max:10',
            'aadhar_no' => 'required|max:12',
            'gender' => 'required',
            'dob' => 'required',
            'profile_photo' => 'required',
            'certificates' => 'required',
            //'hospital_logo' => 'required|mimes:jpg|max:2048',
        );
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $doctor = new Doctor();
            $doctor_id_find  = DB::table('doctors')->orderBy('doctor_id', 'DESC')->first();
            $doctor_id =substr($doctor_id_find->doctor_id ?? 'VIP/2021/0000', -1) +1 ;
            $profile_photo = $request->profile_photo;
            $doc_certificates = $request->certificates;
            if ($profile_photo) {
                $destinationPath = public_path() . '/upload_file/doctor/';
                $fileName = $request->name . '_' . $request->profile_photo->getClientOriginalName();
                $profile_photo->move($destinationPath, $fileName);
                $doctor->profile_photo = $fileName;
            }
            $doctor->doctor_id  ='VIP/2021/000'.$doctor_id ;
            $doctor->name = $request->name;
            $doctor->degree = $request->degree;
            $doctor->specialist = $request->specialist;
            $doctor->mobile_no = $request->mobile_no;
            $doctor->email  = $request->email;
            $doctor->address  = $request->address;
            $doctor->city = $request->city;
            $doctor->state = $request->state;
            $doctor->pin_code	 = $request->pin_code;
            $doctor->aadhar_no	 = $request->aadhar_no;
            $doctor->gender	 = $request->gender;
            $doctor->dob = $request->dob;
            $doctor->password = Hash::make($request->mobile_no);;
            $doctor->save();

            $doc_id = DB::table('doctors')->orderBy('id', 'DESC')->first();
            if($doc_certificates)
            {
                $certificates_destinationPath = public_path() . '/upload_file/doctor/doctor_certificates/';
                foreach($doc_certificates as $key => $certificates)
                {
                    $certificate_temp = $certificates->getClientOriginalName();
                    //dd($certificate_temp);
                    $certificate_type = pathinfo($certificate_temp, PATHINFO_FILENAME); // file
                    //dd($certificate_type);
                    $certificate= new Certificate();
                    $certificates_name = date('d_m_Y') . time() . '_' . $certificate_temp;
                    $certificate::create([
                        'doc_id' => $doc_id->id,
                        'degree_name' => $certificate_type,
                        'certificate_name' => $certificates_name,
                        'certificate_file_path' => '/upload_file/doctor/doctor_certificates/'.$certificates_name,
                    ]);
                    $certificates->move($certificates_destinationPath, $certificates_name);
                }
            }

            session()->flash('message', 'Hospital Details Update Successfully..!');
            return redirect()->back();
        }
    }
}
