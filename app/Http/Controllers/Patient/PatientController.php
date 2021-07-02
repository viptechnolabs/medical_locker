<?php

namespace App\Http\Controllers\Patient;

use App\DataTables\PatientDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patients;
use App\Models\Report;
use App\Models\State;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    //
    public function index(PatientDataTable $dataTable)
    {
        $hospital = Hospital::findOrFail(1);
        if (Auth::guard('hospital')->check()) {
            $patients = Patients::orderBy('id', 'DESC')->get();
        } elseif (Auth::guard('doctor')->check()) {
            $patients = Report::where('consultant_doctor', Auth::guard('doctor')->user()->id)->orderBy('id', 'DESC')->get();
        } elseif (Auth::guard('web')->check()) {
            $patients = Patients::orderBy('id', 'DESC')->get();
        }
        return view('patient.index', ['hospital' => $hospital, 'patients' => $patients]);
    }

    public function addPatient()
    {
        $hospital = Hospital::findOrFail(1);
        $state = State::all();
        $city = City::all();
        return view('patient.add_patient', ['hospital' => $hospital, 'states' => $state, 'cities' => $city]);
    }

    public function submitPatient(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|max:50|min:7',
            'mobile_no' => 'required|max:13|min:7',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin_code' => 'required|max:10',
            'aadhar_no' => 'required|max:12',
            'gender' => 'required',
            'dob' => 'required',
        );
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $patient = new Patients();
            $patient_id_find = Patients::orderBy('patient_id', 'DESC')->first();
            $patient_id = substr($patient_id_find->patient_id ?? 'VIP/PE/2021/0', -1) + 1;
            $patient->patient_id = 'VIP/PE/2021/' . $patient_id;
            $patient->name = $request->name;
            $patient->mobile_no = $request->mobile_no;
            $patient->email = $request->email;
            $patient->address = $request->address;
            $patient->city = $request->city;
            $patient->state = $request->state;
            $patient->pin_code = $request->pin_code;
            $patient->aadhar_no = $request->aadhar_no;
            $patient->gender = $request->gender;
            $patient->dob = $request->dob;
            $profile_photo = $request->profile_photo;
            $document = $request->document;

            if ($profile_photo) {
                $destinationPath = public_path() . '/upload_file/patient/';
                $fileName = $request->name . '_' . $request->profile_photo->getClientOriginalName();
                $patient->profile_photo = $fileName;
                $profile_photo->move($destinationPath, $fileName);
            }
            if ($document) {
                $destinationPath = public_path() . '/upload_file/patient/patient_document/';
                $fileName = $request->aadhar_no . '_' . $request->document->getClientOriginalName();
                $patient->document_photo = $fileName;
                $document->move($destinationPath, $fileName);
            }
            $patient->save();

            activity('Add patient')
                ->performedOn($patient)
                ->log('(' . $patient->patient_id . ') ' . $request->name . ' are added');

            // Second Method USe
            $patient_id = DB::table('patients')->orderBy('id', 'DESC')->first();
            session()->flash('message', 'Patient Add Successfully..!');
            return redirect()->route('patient.add_report', $patient_id->id);
        }

    }


    public function patientDetails(Request $request, $id)
    {
        $patient = Patients::findOrFail($id);
        $hospital = Hospital::findOrFail(1);
        $report = Report::with('doctor')->where('patient_id', $id)->get();
        $state = State::all();
        $city = City::all();
        return view('patient.patient_details', ['patient' => $patient, 'hospital' => $hospital, 'states' => $state, 'cities' => $city, 'reports' => $report]);
    }

    public function patientDetailsUpdate(Request $request)
    {
        $rules = array(
            'name' => 'required',
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
            $patient = Patients::findOrFail($request->id);
            $patient->name = $request->name;
            $patient->email = $request->email;
            $patient->mobile_no = $request->mobile_no;
            $patient->address = $request->address;
            $patient->state = $request->state;
            $patient->city = $request->city;
            $patient->pin_code = $request->pin_code;
            $patient->aadhar_no = $request->aadhar_no;
            $patient->dob = $request->dob;
            $profile_photo = $request->profile_photo;
            $document_photo = $request->document_photo;
            if ($profile_photo) {
                $destinationPath = public_path() . '/upload_file/patient/';
                $fileName = $request->name . '_' . $request->profile_photo->getClientOriginalName();
                if ($patient->profile_photo) {
                    $image_path = public_path("upload_file/patient/{$patient->profile_photo}");
                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                }

                $profile_photo->move($destinationPath, $fileName);
                $patient->profile_photo = $fileName;
            }
            if ($document_photo) {
                $destinationPath = public_path() . '/upload_file/patient/patient_document';
                $fileName = $request->aadhar_no . '_' . $request->document_photo->getClientOriginalName();
                if ($patient->document_photo) {
                    $image_path = public_path("upload_file/patient/patient_document/{$patient->document_photo}");
                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                }
                $document_photo->move($destinationPath, $fileName);
                $patient->document_photo = $fileName;
            }
            $patient->save();

            activity('Update patient')
                ->performedOn($patient)
                ->log('(' . $patient->patient_id . ') ' . $request->name . ' are updated');

            session()->flash('message', 'Patient Details Update Successfully..!');
            return redirect()->back();
        }
    }


    public function addReport(Request $request, $id)
    {
        $patient = Patients::findOrFail($id);
        $hospital = Hospital::findOrFail(1);
        $doctor = Doctor::all();
        return view('patient.add_report', ['patient' => $patient, 'hospital' => $hospital, 'doctors' => $doctor]);
    }

    public function submitReport(Request $request)
    {
        $rules = array(
            'patient_id' => 'required',
            'consultant_doctor' => 'required',
            'routine_checkup' => 'required',
            'type' => 'required',
            'treatment_name' => 'required',
            'insurance' => 'required',
            'consultant_date' => 'required',
            'file' => 'required',
        );
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $report = new Report();
            $report->patient_id = $request->id;
            $report->consultant_doctor = $request->consultant_doctor;
            $report->routine_checkup = $request->routine_checkup;
            $report->type = $request->type;
            $report->treatment_name = $request->treatment_name;
            $report->insurance = $request->insurance;
            $report->consultant_date = $request->consultant_date;
            $file = $request->file;

            if ($file) {
                $destinationPath = public_path() . '/upload_file/patient/patient_report/' . str_replace('/', '_', $request->patient_id) . '/';
                $fileName = date('d-m-Y', strtotime($request->consultant_date)) . '_' . $request->file->getClientOriginalName();
                $report->file_name = $fileName;
                $report->file_path = '/upload_file/patient/patient_report/' . str_replace('/', '_', $request->patient_id) . '/';
                $file->move($destinationPath, $fileName);
            }
            $report->save();

            activity('Add report')
                ->performedOn($report)
                ->log('(' . $report->patient[0]->patient_id . ') ' . $request->name . ' report added');

            session()->flash('message', 'Patient Report Add Successfully..!');
            return redirect()->route('patient.patient_details', $request->id);
        }

    }

    public function reportDownload($id)
    {
        $report = Report::findOrFail($id);

        activity('Report download')
            ->performedOn($report)
            ->log('(' . $report->patient[0]->patient_id . ') ' . $report->patient[0]->name . ' report downloaded');

        return Response::download(public_path($report->file_path . $report->file_name), str_replace('/', '_', $report->patient[0]->patient_id) . '_' . $report->file_name);
    }

    public function patientListDownload()
    {
        if (Auth::guard('hospital')->check()) {
            $patients = Patients::all();
        } elseif (Auth::guard('doctor')->check()) {
            $patients = Report::where('consultant_doctor', Auth::guard('doctor')->user()->id)->get();
        }

        activity('Patient list download')
            ->log('Patient list downloaded');

        view()->share('patients', $patients);
        $pdf = PDF::loadView('patient.patient_list', $patients);
        return $pdf->download('patient_list.pdf');
    }
}
