<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Validation\Validator;

class HospitalController extends Controller
{
    //
    function index()
    {
        $hospital = Hospital::all();
        return view('index', ['hospital' => $hospital]);
    }

    function login()
    {
       // $hospital = Hospital::all();
        return view('login');
    }

    function hospitalDetails()
    {
        $hospital = Hospital::all();
        return view('hospital_details', ['hospital' => $hospital]);
    }

    function hospitalDetailsUpdate(Request $request)
    {
        $rules = array(
            'hospital_name' => 'required',
            'hospital_details' => 'required',
            //            'hospital_email' => 'required|unique:hospitals|max:255',
            'hospital_mobile_no' => 'required|max:13',
            'hospital_fex_no' => 'required|max:13',
            'hospital_address' => 'required',
            'password' => 'required|min:5',
            'confirm_password' => 'required_with:password|same:password|min:6',
        );


        // $rules = array('email' => 'required|email','password' => 'required | min:6');

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $hospital =  Hospital::find(1);
            dd($hospital);


            //return redirect()->back();
        }
    }
}
