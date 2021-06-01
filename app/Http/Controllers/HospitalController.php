<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Validation\Validator;

class HospitalController extends Controller
{
    //
    public function index()
    {
        $hospital = Hospital::all();
        return view('index', ['hospital' => $hospital]);
    }

    public function login()
    {
        // $hospital = Hospital::all();
        return view('login');
    }

    public function hospitalDetails()
    {
        $hospital = Hospital::all();
        return view('hospital_details', ['hospital' => $hospital]);
    }

    public function hospitalDetailsUpdate(Request $request)
    {
        $rules = array(
            'hospital_name' => 'required',
            'hospital_details' => 'required',
            'hospital_fex_no' => 'required|max:13',
            'hospital_pin_cord_no' => 'required|max:10',
            'hospital_address' => 'required',
            //'hospital_logo' => 'required|mimes:jpg|max:2048',
        );


        // $rules = array('email' => 'required|email','password' => 'required | min:6');

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $hospital = Hospital::findOrFail(1);
            $file = $request->hospital_logo;
            if ($file) {
                $destinationPath = public_path() . '/upload_file/';
                $fileName = date('d_m_Y') . time() . '_' . $request->hospital_logo->getClientOriginalName();
                $image_path = public_path("upload_file/{$hospital->logo}");
                if (File::exists($image_path)) {
                    //File::delete($image_path);
                    unlink($image_path);
                }
                $file->move($destinationPath, $fileName);
                $hospital->logo = $fileName;
                //dd($hospital, $fileName, $uploadSuccess, $destinationPath, $uploadSuccess);
            }
            $hospital->name = $request->hospital_name;
            $hospital->details = $request->hospital_details;
            $hospital->fex_no = $request->hospital_fex_no;
            $hospital->address = $request->hospital_address;
            $hospital->pin_cord_no = $request->hospital_pin_cord_no;
            $hospital->password = Hash::make($request->password);;
            $hospital->save();
            session()->flash('message', 'Hospital Details Update Successfully..!');
            return redirect()->back();
        }
    }

    public function hospitalChangePassword(Request $request)
    {
       // dd($request->all());
        $rules = array(
            'password' => 'min:5',
            'confirm_password' => 'required_with:password|same:password|min:5',
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $hospital = Hospital::findOrFail(1);
            $hospital->password = Hash::make($request->password);;
            $hospital->save();
            session()->flash('message', 'Password Change Successfully..!');
            return redirect()->back();
        }
    }

    public function hospitalUpdateMobileNo(Request $request)
    {
       // dd('here');
        $rules = array(
            'hospital_mobile_no' => 'required|max:13|min:7',
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $hospital = Hospital::findOrFail(1);
            $hospital->mobile_no = $request->hospital_mobile_no;
            $hospital->save();
            session()->flash('message', 'Mobile Update Successfully..!');
            return redirect()->back();
        }
    }

    public function hospitalUpdateEmail(Request $request)
    {
        // dd('here');
        $rules = array(
            'hospital_email' => 'required|max:25',
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $hospital = Hospital::findOrFail(1);
            $hospital->email = $request->hospital_email;
            $hospital->save();
            session()->flash('message', 'Email id Update Successfully..!');
            return redirect()->back();
        }
    }
}
