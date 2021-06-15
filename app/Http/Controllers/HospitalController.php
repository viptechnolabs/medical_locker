<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Notifications\ChangeEmail;
use App\Notifications\ChangeMobileNo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


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
        return view('login');
    }

    public function hospitalDetails()
    {
        $hospital = Hospital::all();
        return view('hospital_details', ['hospital' => $hospital]);
    }

    public function getEmailPopup(Request $request)
    {
        $hospital = Hospital::all();
        return view('components.update-email')->with('hospital', $hospital);;
    }

    public function getMobilePopup(Request $request)
    {
        $hospital = Hospital::all();
        return view('components.update-mobileno')->with('hospital', $hospital);;
    }

    public function checkEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        # Request params
        $email = $request->input('email');
        $id = $request->input('id') ?? null;

        $queryBuilder = Hospital::where('email', $email);
        if ($id) {
            $queryBuilder->where('id', '!=', $id);
        }

        $exists = $queryBuilder->exists();

        if (!$exists) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }


    public function checkMobile(Request $request): \Illuminate\Http\JsonResponse
    {
        # Request params
        $mobile_no = $request->input('mobile_no');
        $id = $request->input('id') ?? null;

        $queryBuilder = Hospital::where('mobile_no', $mobile_no);
        if ($id) {
            $queryBuilder->where('id', '!=', $id);
        }

        $exists = $queryBuilder->exists();

        if (!$exists) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function checkPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        dd($request->all());
        # Request params
        $password = $request->input('current_password');

        $user = auth()->user();

        if (Hash::check($password, $user->password)) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }



    public function hospitalDetailsUpdate(Request $request)
    {
        $rules = array(
            'hospital_name' => 'required',
            'hospital_details' => 'required',
            'hospital_fex_no' => 'required|max:13',
            'hospital_pin_cord_no' => 'required|max:10',
            'hospital_address' => 'required',
        );

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
                    unlink($image_path);
                }
                $file->move($destinationPath, $fileName);
                $hospital->logo = $fileName;
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

    public function changePassword(Request $request)
    {
        $id = $request->id;
        $user_type = $request->user_type;
        $rules = array(
            'password' => 'min:5',
            'confirm_password' => 'required_with:password|same:password|min:5',
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            if ($user_type === 'doctor')
            {
                $doctor = Doctor::findOrFail($id);
                $doctor->password = Hash::make($request->password);
                $doctor->save();
            }
            elseif($user_type === 'hospital')
            {
                $hospital = Hospital::findOrFail($id);
                $hospital->password = Hash::make($request->password);;
                $hospital->save();
            }
            session()->flash('message', 'Password Change Successfully..!');
            return redirect()->back();
        }
    }

    public function hospitalUpdateMobileNo(Request $request): \Illuminate\Http\JsonResponse
    {
        $code = $request->verification_code;
        $id = $request->input('id');
        $newMobile = $request->newMobile;
        $hospital = Hospital::find($id);
        $dbcode = $hospital->verification_code;
        if ($dbcode === $code) {
            $hospital->mobile_no = $newMobile;
            $hospital->verification_code = null;
            $hospital->token = null;
            $hospital->save();

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'message' => 'error',
                'status' => 400,
            ])->setStatusCode(400);
        }
    }

    public function email_verification_code(Request $request)
    {
        # Find user
        $id = $request->input('id');
        $new_email = $request->input('newmail');
        $data = Hospital::where('email', $new_email);
        $exists = $data->exists();

        if ($exists) {
            return response()->json([
                'message' => 'This email already registered with us.',
                'status' => 401,
            ])->setStatusCode(401);
        } else {
            $hospital = Hospital::find($id);
            $six_digit_random_number = mt_rand(111111, 999999);
            $token = Str::random(20);

            $hospital->token = $token;
            $hospital->verification_code = $six_digit_random_number;
            $hospital->save();

            # Send mail invitation
            $hospital->notify(new ChangeEmail($hospital, $six_digit_random_number));

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ])->setStatusCode(200);

        }
    }

    public function mobile_verification_code(Request $request)
    {
        # Find user
        $id = $request->input('id');
        $new_mobile_no = $request->input('newMobile');
        $temp_new_mobile_no = '91' . $request->input('newMobile');
        $data = Hospital::where('mobile_no', $new_mobile_no);
        $exists = $data->exists();
        if ($exists) {
            return response()->json([
                'message' => 'This mobile no already registered with us.',
                'status' => 401,
            ])->setStatusCode(401);
        } else {
            $hospital = Hospital::find($id);
            $six_digit_random_number = mt_rand(111111, 999999);
            $token = Str::random(20);

            $hospital->token = $token;
            $hospital->verification_code = $six_digit_random_number;
            $hospital->save();
            # Send mail invitation
            Notification::route('nexmo', $temp_new_mobile_no)->notify(new ChangeMobileNo($hospital, $six_digit_random_number));

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ])->setStatusCode(200);

        }
    }

    public function hospitalUpdateEmail(Request $request)
    {

        $code = $request->verification_code;
        $id = $request->input('id');
        $newemail = $request->newMail;
        $hospital = Hospital::find($id);
        $dbcode = $hospital->verification_code;
        if ($dbcode === $code) {
            //dd($newemail, $dbcode, $code);
            $hospital->email = $newemail;
            $hospital->verification_code = null;
            $hospital->token = null;
            $hospital->save();
//            if($request->user()->isTaTeamUser()){
//                $this->setLeaderActivity($request->user(), $hospital, 'candidate_email');
//            }

            return response()->json([
                'message' => 'ok',
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'message' => 'error',
                'status' => 400,
            ])->setStatusCode(400);
        }
    }
}
