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
        $doctors = Doctor::all();
        //dd($doctors[0]->name);
        return view('doctor.index', ['hospital' => $hospital, 'doctors' => $doctors]);
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
            'specialist' => 'required',
            'email' => 'required|max:50|min:7',
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
            $doctor_id_find  = Doctor::withTrashed()->orderBy('doctor_id', 'DESC')->first();
            $doctor_id =substr($doctor_id_find->doctor_id ?? 'VIP/DR/2021/0000', -1) +1 ;
            $profile_photo = $request->profile_photo;
            $document = $request->document;
            $doctor->doctor_id  ='VIP/DR/2021/000'.$doctor_id ;
            $doctor->name = $request->name;
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
            $doctor->password = Hash::make($request->mobile_no);

            if ($profile_photo) {
                $destinationPath = public_path() . '/upload_file/doctor/';
                $fileName = $request->name . '_' . $request->profile_photo->getClientOriginalName();
                $doctor->profile_photo = $fileName;
                $profile_photo->move($destinationPath, $fileName);
            }
            if ($document) {
                $destinationPath = public_path() . '/upload_file/doctor/doctor_document/';
                $fileName = $request->name . '_' . $request->document->getClientOriginalName();
                $doctor->document_photo = $fileName;
                $document->move($destinationPath, $fileName);
            }
            $doctor->save();


            $doc_certificates = $request->certificates;
            $doc_id = DB::table('doctors')->orderBy('id', 'DESC')->first();
            $doc_degree = $request->degree;
            if($doc_certificates)
            {
                $certificates_destinationPath = public_path() . '/upload_file/doctor/doctor_certificates/';
                foreach($doc_certificates as $key => $certificates)
                {
                    $certificate_temp = $certificates->getClientOriginalName();
                    $degree_temp = (isset($doc_degree[$key]))? $doc_degree[$key]: null;

                    $certificate= new Certificate();
                    $certificates_name = $degree_temp. '_' . $certificate_temp;
                    $certificate::create([
                        'doc_id' => $doc_id->id,
                        'degree_name' => $degree_temp,
                        'certificate_name' => $certificates_name,
                        'certificate_file_path' => '/upload_file/doctor/doctor_certificates/'.$certificates_name,
                    ]);
                    $certificates->move($certificates_destinationPath, $certificates_name);
                }
            }
            session()->flash('message', 'Doctor Add Successfully..!');
            return redirect()->route('doctor.index');
        }
    }

    public function doctorChangeStatus(Request $request)
    {
        dd('hello');
    }


}
