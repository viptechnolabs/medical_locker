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
use voku\helper\ASCII;

class DoctorController extends Controller
{
    //
    public function index(Request $request)
    {
        $hospital = Hospital::findOrFail(1);
        $doctors = Doctor::query();
        $search = $request->doctor_search;
        if ($search)
        {
            $doctors = $doctors->where("doctor_id","like","%".$search."%")->orWhere("name","like","%".$search."%")
                ->orWhere("mobile_no","like","%".$search."%")
                ->orWhere("email","like","%".$search."%")
                ->orWhere("dob","like","%".$search."%");
        }
        $doctors = $doctors->get();
        return view('doctor.index', ['hospital' => $hospital, 'doctors' => $doctors]);
    }

    public function addDoctor()
    {
        $hospital = Hospital::findOrFail(1);
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
                $fileName = $request->aadhar_no . '_' . $request->document->getClientOriginalName();
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


    public function doctorDetails(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $hospital = Hospital::findOrFail(1);
        $state = State::all();
        $city = City::all();
        return view('doctor.doctor_details', ['doctor' => $doctor, 'hospital' => $hospital, 'states' => $state, 'cities' => $city]);
    }

    public function doctorDetailsUpdate(Request $request)
    {
        //dd($request->all());

        $rules = array(
            'name' => 'required',
            'specialist' => 'required',
            'email' => 'required|email',
            'mobile_no' => 'required|max:13',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin_code' => 'required|max:10',
            'aadhar_no' => 'required|max:13',
            'dob' => 'required',
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $doctor = Doctor::findOrFail($request->id);
            $doctor->name = $request->name;
            $doctor->specialist = $request->specialist;
            $doctor->email = $request->email;
            $doctor->mobile_no = $request->mobile_no;
            $doctor->address = $request->address;
            $doctor->state = $request->state;
            $doctor->city = $request->city;
            $doctor->pin_code = $request->pin_code;
            $doctor->aadhar_no = $request->aadhar_no;
            $doctor->dob = $request->dob;
            $profile_photo = $request->profile_photo;
            $document_photo = $request->document_photo;
            if ($profile_photo) {
                $destinationPath = public_path() . '/upload_file/doctor/';
                $fileName = $request->name . '_' . $request->profile_photo->getClientOriginalName();
                $image_path = public_path("upload_file/doctor/{$doctor->profile_photo}");
                if (File::exists($image_path)) {
                    unlink($image_path);
                }
                $profile_photo->move($destinationPath, $fileName);
                $doctor->profile_photo = $fileName;
            }
            if ($document_photo) {
                $destinationPath = public_path() . '/upload_file/doctor/doctor_document';
                $fileName = $request->aadhar_no . '_' . $request->document_photo->getClientOriginalName();
                $image_path = public_path("upload_file/doctor/doctor_document/{$doctor->document_photo}");
                if (File::exists($image_path)) {
                    unlink($image_path);
                }
                $document_photo->move($destinationPath, $fileName);
                $doctor->document_photo = $fileName;
            }

            $doc_certificates = $request->certificates;
            //$doc_id = DB::table('doctors')->orderBy('id', 'DESC')->first();
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
                        'doc_id' => $request->id,
                        'degree_name' => $degree_temp,
                        'certificate_name' => $certificates_name,
                        'certificate_file_path' => '/upload_file/doctor/doctor_certificates/'.$certificates_name,
                    ]);
                    $certificates->move($certificates_destinationPath, $certificates_name);
                }
            }

            $doctor->save();
            session()->flash('message', 'Doctor Details Update Successfully..!');
            return redirect()->back();
        }
    }


    public function doctorDelete($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        session()->flash('message', 'Dr. '.$doctor->name.' are Delete Successfully..!');
        return redirect()->route('doctor.index');
    }

    public function deletedDoctor()
    {
        $hospital = Hospital::findOrFail(1);
        $deleted_doctor = Doctor::onlyTrashed()->get();
//        dd($deleted_doctor);
        return view('doctor.deleted_doctor', ['hospital' => $hospital, 'doctors' => $deleted_doctor]);
    }

    public function restoreDoctor($id)
    {
        $doctor = Doctor::withTrashed()->findOrFail($id);
        $doctor->restore();
        session()->flash('message', 'Dr. '.$doctor->name.' Restore Successfully..!');
        return redirect()->route('doctor.index');
    }


    public function changeStatusPopup(Request $request)
    {
        # Request params
        $action = $request->input('action');
        $message = $request->input('message');
        return view('components.change-status', ['action' => $action, 'message' => $message]);
//        return view('components.change-status')
//            ->with('action', $action);
    }

    public function changeStatus($id): \Illuminate\Http\RedirectResponse
    {
        # Get Employer
        $doctor = Doctor::findOrFail($id);
        $doctor->status = ($doctor->status === "active") ? "inactive" : "active";
        $doctor->save();
        return redirect()->back();
    }


}
