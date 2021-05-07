<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

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
        dd($request->all());
    }
}
