<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\State;
use App\Models\User;
use App\Notifications\ChangeEmail;
use App\Notifications\ChangeMobileNo;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
//use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{

    public function index()
    {
            $hospital = Hospital::findOrFail(1);
             return  view('index', ['hospital' => $hospital]);
    }

    public function login()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        //$userType = array('hospital','doctor','user');
        if($request->user_type === 'hospital') {
            if(Auth::guard('hospital')->attempt($request->only('email','password'),$request->filled('remember'))){
                //Authentication passed...
                Session::put('userType', 'hospital' );
                return redirect()->route('index');
            }
        }
        elseif($request->user_type === 'doctor') {
            if(Auth::guard('doctor')->attempt($request->only('email','password'),$request->filled('remember'))){
                //Authentication passed...
                Session::put('userType', 'doctor' );
                return redirect()->route('index');
            }
        }
        //Authentication failed...
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');

    }


    public function logout()
    {
        if (Session::get('userType') === 'hospital')
        {
            Auth::guard('hospital')->logout();
        }
        elseif (Session::get('userType') === 'doctor')
        {
            Auth::guard('doctor')->logout();
        }
        return redirect()
            ->route('login')
            ->with('status','Admin has been logged out!');
    }
    public function hospitalDetails()
    {
        $hospital = Hospital::findOrFail(1);
        return view('hospital_details', ['hospital' => $hospital]);
    }

    public function profile($user_type, $id)
    {
        $hospital = Hospital::findOrFail(1);
        if($user_type === 'doctor')
        {
            $doctor = Doctor::findOrFail($id);
            $state = State::all();
            $city = City::all();
            return view('doctor.doctor_details', ['doctor' => $doctor, 'hospital' => $hospital, 'states' => $state, 'cities' => $city]);
        }
        elseif ($user_type === 'user')
        {
            dd($user_type, $id);
        }
    }

    public function getEmailPopup(Request $request)
    {
        $id = $request->user_id;
        if($request->user_type === 'hospital') {
            $data = Hospital::findOrFail($id);
        }
        elseif ($request->user_type === 'doctor') {
            $data = Doctor::findOrFail($id);
        }
        return view('components.update-email', ['data' => $data, 'user_type' => $request->user_type]);
    }

    public function getMobilePopup(Request $request)
    {
        $id = $request->user_id;
        if($request->user_type === 'hospital') {
            $data = Hospital::findOrFail($id);
        }
        elseif ($request->user_type === 'doctor') {
            $data = Doctor::findOrFail($id);
        }
        return view('components.update-mobileno', ['data' => $data, 'user_type' => $request->user_type]);
    }

    public function checkEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        # Request params
        $email = $request->input('email');
        $id = $request->input('id') ?? null;
        if($request->user_type === 'hospital')
        {
            $queryBuilder = Hospital::where('email', $email);
            if ($id) {
                $queryBuilder->where('id', '!=', $id);
            }

            $exists = $queryBuilder->exists();
        }
        elseif ($request->user_type === 'doctor')
        {
            $queryBuilder = Doctor::where('email', $email);
            if ($id) {
                $queryBuilder->where('id', '!=', $id);
            }

            $exists = $queryBuilder->exists();
        }

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
        if($request->user_type === 'hospital')
        {
            $queryBuilder = Hospital::where('mobile_no', $mobile_no);
            if ($id) {
                $queryBuilder->where('id', '!=', $id);
            }
            $exists = $queryBuilder->exists();
        }
        elseif ($request->user_type === 'doctor')
        {
            $queryBuilder = Doctor::where('mobile_no', $mobile_no);
            if ($id) {
                $queryBuilder->where('id', '!=', $id);
            }

            $exists = $queryBuilder->exists();
        }
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
            if ($user_type === 'hospital')
            {
                $doctor = Hospital::findOrFail($id);
                $doctor->password = Hash::make($request->password);
                $doctor->save();
            }
            elseif($user_type === 'doctor')
            {
                $hospital = Doctor::findOrFail($id);
                $hospital->password = Hash::make($request->password);;
                $hospital->save();
            }
            elseif($user_type === 'user')
            {
                $hospital = User::findOrFail($id);
                $hospital->password = Hash::make($request->password);;
                $hospital->save();
            }
            session()->flash('message', 'Password Change Successfully..!');
            return redirect()->back();
        }
    }

    public function email_verification_code(Request $request)
    {
        # Find user
        $id = $request->input('id');
        $new_email = $request->input('newmail');
        $user_type = $request->user_type;
        if ($user_type === 'hospital')
        {
            $data = Hospital::where('email', $new_email);
            $exists = $data->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'This email already registered with us.',
                    'status' => 401,
                ])->setStatusCode(401);
            } else {

                $obj = Hospital::find($id);
                $six_digit_random_number = mt_rand(111111, 999999);
                $token = Str::random(20);

                $obj->token = $token;
                $obj->verification_code = $six_digit_random_number;
                $obj->save();

                # Send mail invitation
                $obj->notify(new ChangeEmail($obj, $six_digit_random_number));

                return response()->json([
                    'message' => 'ok',
                    'status' => 200,
                ])->setStatusCode(200);

            }
        }

        elseif ($user_type === 'doctor')
        {
            $data = Doctor::where('email', $new_email);
            $exists = $data->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'This email already registered with us.',
                    'status' => 401,
                ])->setStatusCode(401);
            } else {
                $obj = Doctor::find($id);
                $six_digit_random_number = mt_rand(111111, 999999);
                $token = Str::random(20);

                $obj->token = $token;
                $obj->verification_code = $six_digit_random_number;
                $obj->save();

                # Send mail invitation
                $obj->notify(new ChangeEmail($obj, $six_digit_random_number));

                return response()->json([
                    'message' => 'ok',
                    'status' => 200,
                ])->setStatusCode(200);

            }
        }

    }

    public function mobile_verification_code(Request $request)
    {
        # Find user
        $id = $request->input('id');
        $new_mobile_no = $request->input('newMobile');
        $temp_new_mobile_no = '91' . $request->input('newMobile');
        $user_type = $request->user_type;
        if ($user_type === 'hospital')
        {
            $data = Hospital::where('mobile_no', $new_mobile_no);
            $exists = $data->exists();
            if ($exists) {
                return response()->json([
                    'message' => 'This mobile no already registered with us.',
                    'status' => 401,
                ])->setStatusCode(401);
            } else {
                $obj = Hospital::find($id);
                $six_digit_random_number = mt_rand(111111, 999999);
                $token = Str::random(20);

                $obj->token = $token;
                $obj->verification_code = $six_digit_random_number;
                $obj->save();
                # Send mail invitation
                Notification::route('nexmo', $temp_new_mobile_no)->notify(new ChangeMobileNo($obj, $six_digit_random_number));

                return response()->json([
                    'message' => 'ok',
                    'status' => 200,
                ])->setStatusCode(200);

            }
        }
        elseif ($user_type === 'doctor')
        {
            $data = Doctor::where('mobile_no', $new_mobile_no);
            $exists = $data->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'This email already registered with us.',
                    'status' => 401,
                ])->setStatusCode(401);
            } else {
                $obj = Doctor::find($id);
                $six_digit_random_number = mt_rand(111111, 999999);
                $token = Str::random(20);

                $obj->token = $token;
                $obj->verification_code = $six_digit_random_number;
                $obj->save();

                # Send mail invitation
                Notification::route('nexmo', $temp_new_mobile_no)->notify(new ChangeMobileNo($obj, $six_digit_random_number));

                return response()->json([
                    'message' => 'ok',
                    'status' => 200,
                ])->setStatusCode(200);

            }
        }
    }

    public function hospitalUpdateEmail(Request $request)
    {

        $code = $request->verification_code;
        $id = $request->input('id');
        $newemail = $request->newMail;
        $user_type = $request->user_type;
        if ($user_type === 'hospital') {
            $hospital = Hospital::find($id);
            $dbcode = $hospital->verification_code;
            if ($dbcode === $code) {
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

        elseif ($user_type === 'doctor')
        {
            $doctor = Doctor::find($id);
            $dbcode = $doctor->verification_code;
            if ($dbcode === $code) {
                $doctor->email = $newemail;
                $doctor->verification_code = null;
                $doctor->token = null;
                $doctor->save();
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

    public function hospitalUpdateMobileNo(Request $request): \Illuminate\Http\JsonResponse
    {
        $code = $request->verification_code;
        $id = $request->input('id');
        $newMobile = $request->newMobile;
        $user_type = $request->user_type;
        if ($user_type === 'hospital') {
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
        elseif ($user_type === 'doctor')
        {
            $doctor = Doctor::find($id);
            $dbcode = $doctor->verification_code;
            if ($dbcode === $code) {
                $doctor->mobile_no = $newMobile;
                $doctor->verification_code = null;
                $doctor->token = null;
                $doctor->save();
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

    public function changeStatusPopup(Request $request)
    {
        # Request params
        $action = $request->input('action');
        $message = $request->input('message');
        $user_type = $request->input('user_type');
        return view('components.change-status', ['action' => $action, 'message' => $message, 'user_type' => $user_type]);
//        return view('components.change-status')
//            ->with('action', $action);
    }

    public function changeStatus(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        if ($request->user_type === 'doctor')
        {
            $doctor = Doctor::findOrFail($id);
            $doctor->status = ($doctor->status === "active") ? "inactive" : "active";
            session()->flash('message', $doctor->name.' Status Updated..!');
            $doctor->save();
        }
        elseif ($request->user_type === 'user')
        {
            $user = User::findOrFail($id);
            $user->status = ($user->status === "active") ? "inactive" : "active";
            session()->flash('message', $user->name.' Status Updated..!');
            $user->save();
        }

        return redirect()->back();
    }

    public function restore(Request $request, $id)
    {
       // dd($request->all(), $id);
        if ($request->user_type === 'doctor') {
            $doctor = Doctor::withTrashed()->findOrFail($id);
            $doctor->restore();
            session()->flash('message', 'Dr. '.$doctor->name.' Restore Successfully..!');
            return redirect()->route('doctor.index');
        }

        elseif ($request->user_type === 'user')
        {
            $user = User::withTrashed()->findOrFail($id);
            $user->restore();
            session()->flash('message', $user->name . ' Restore Successfully..!');
            return redirect()->route('user.index');
        }
    }


}
