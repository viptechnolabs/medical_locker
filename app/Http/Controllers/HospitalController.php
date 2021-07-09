<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patients;
use App\Models\Report;
use App\Models\State;
use App\Models\User;
use App\Notifications\ChangeEmail;
use App\Notifications\ChangeMobileNo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;

class HospitalController extends Controller
{

    public function index()
    {
        $hospital = Hospital::findOrFail(1);
        $doctors = Doctor::orderBy('id', 'DESC')->take(5)->get();
        $users = User::orderBy('id', 'DESC')->take(5)->get();
        $patients = Patients::orderBy('id', 'DESC')->take(5)->get();
        $activities = Activity::orderBy('id', 'DESC')->take(5)->get();
        return view('index', ['hospital' => $hospital, 'doctors' => $doctors, 'users' => $users, 'patients' => $patients, 'activities' => $activities]);
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('index');
        } else {
            return view('login');
        }
    }

    public function doLogin(Request $request)
    {
        if ($request->user_type === 'hospital') {
            if (Auth::guard('hospital')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
                Session::put('userType', 'hospital');
                //Authentication passed...
                activity('Login')
                    ->performedOn(Auth::guard('hospital')->user())
                    ->causedBy(Auth::guard('hospital')->user())
                    ->log(Auth::guard('hospital')->user()->name . ' Hospital login');

                return redirect()->route('index');
            }
        } elseif ($request->user_type === 'doctor') {
            if (Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $request->filled('remember'))) {
                //Authentication passed...
                activity('Doctor login')
                    ->performedOn(Auth::guard('doctor')->user())
                    ->causedBy(Auth::guard('doctor')->user())
                    ->log('Dr. ' . Auth::guard('doctor')->user()->name . ' are login');
                Session::put('userType', 'doctor');
                return redirect()->route('index');
            }
        } elseif ($request->user_type === 'user') {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $request->filled('remember'))) {
                //Authentication passed...
                activity('User login')
                    ->performedOn(Auth::guard('web')->user())
                    ->causedBy(Auth::guard('web')->user())
                    ->log(Auth::guard('web')->user()->name . ' are     login');
                Session::put('userType', 'user');
                return redirect()->route('index');
            }
        }
        //Authentication failed...
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Login failed, please try again!');

    }


    public function logout()
    {
        if (Session::get('userType') === 'hospital') {

            activity('Logout')
                ->performedOn(Auth::guard('hospital')->user())
                ->causedBy(Auth::guard('hospital')->user())
                ->log(Auth::guard('hospital')->user()->name . ' are logout');

            Session::flush();
            Auth::guard('hospital')->logout();

        } elseif (Session::get('userType') === 'doctor') {

            activity('Doctor logout')
                ->performedOn(Auth::guard('doctor')->user())
                ->causedBy(Auth::guard('doctor')->user())
                ->log('Dr. ' . Auth::guard('doctor')->user()->name . ' are logout');

            Session::flush();
            Auth::guard('doctor')->logout();

        } elseif (Session::get('userType') === 'user') {

            activity('User logout')
                ->performedOn(Auth::guard('web')->user())
                ->causedBy(Auth::guard('web')->user())
                ->log(Auth::guard('web')->user()->name . ' are logout');

            Session::flush();
            Auth::logout();
        }
        return redirect()
            ->route('login')
            ->with('status', 'Logout successfully...!');
    }

    public function activity()
    {
        $hospital = Hospital::findOrFail(1);
        $activities = Activity::orderBy('id', 'DESC')->get(); //returns the last logged activity
        return view('activity', ['activities' => $activities, 'hospital' => $hospital,]);
    }

    public function activityDelete(Request $request)
    {
        if ($request->option) {
            if ($request->option === 'all')
            {
                Activity::truncate();
            }
            elseif ($request->option === 'last_day')
            {
                Activity::where('created_at', '>=', Carbon::today()->subDays(1))->delete();
            }
            elseif ($request->option === 'last_week')
            {
                Activity::where('created_at', '>=', Carbon::today()->subDays(1))->delete();
            }
            elseif ($request->option === 'current_month')
            {
                Activity::whereMonth('created_at', Carbon::now()->month)->delete();
            }
            elseif ($request->option === 'last_month')
            {
                $activity = Activity::where('created_at', '>=', Carbon::now()->subMonth()->month)->delete();
            }
        }
        activity('Activity delete')
            ->log('Activity are deleted');
        session()->flash('message', 'Selected activity are deleted..!');
        return redirect()->back();

    }

    public function hospitalDetails()
    {
        $hospital = Hospital::findOrFail(1);
        $count_monthly_patients = Patients::select(DB::raw("(COUNT(*)) as count"), DB::raw("MONTHNAME(created_at) as monthname"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('monthname')
            ->get();
        return view('hospital_details', ['hospital' => $hospital, 'count_monthly_patients' => $count_monthly_patients]);
    }

    public function profile()
    {
        $hospital = Hospital::findOrFail(1);
        if (Session::get('userType') === "doctor") {
            $doctor = Doctor::findOrFail(Auth::guard('doctor')->user()->id);
            $state = State::all();
            $city = City::all();
            $count_monthly_patients = Report::select(DB::raw("(COUNT(*)) as count"), DB::raw("MONTHNAME(created_at) as monthname"))
                ->whereYear('created_at', date('Y'))
                ->where('consultant_doctor', Auth::guard('doctor')->user()->id)
                ->groupBy('monthname')
                ->get();
            return view('doctor.doctor_details', ['doctor' => $doctor, 'hospital' => $hospital, 'count_monthly_patients' => $count_monthly_patients, 'states' => $state, 'cities' => $city]);
        } elseif (Session::get('userType') === 'user') {
            $user = User::findOrFail(Auth::guard('web')->user()->id);
            $state = State::all();
            $city = City::all();
            return view('user.user_details', ['user' => $user, 'hospital' => $hospital, 'states' => $state, 'cities' => $city]);
        }
    }

    public function getEmailPopup(Request $request)
    {
        $id = $request->user_id;
        if ($request->user_type === 'hospital') {
            $data = Hospital::findOrFail($id);
        } elseif ($request->user_type === 'doctor') {
            $data = Doctor::findOrFail($id);
        } elseif ($request->user_type === 'user') {
            $data = User::findOrFail($id);
        }
        return view('components.update-email', ['data' => $data, 'user_type' => $request->user_type]);
    }

    public function getMobilePopup(Request $request)
    {
        $id = $request->user_id;
        if ($request->user_type === 'hospital') {
            $data = Hospital::findOrFail($id);
        } elseif ($request->user_type === 'doctor') {
            $data = Doctor::findOrFail($id);
        } elseif ($request->user_type === 'user') {
            $data = User::findOrFail($id);
        }
        return view('components.update-mobileno', ['data' => $data, 'user_type' => $request->user_type]);
    }

    public function checkEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        # Request params
        $email = $request->input('email');
        $id = $request->input('id') ?? null;
        if ($request->user_type === 'hospital') {
            $queryBuilder = Hospital::where('email', $email);
            if ($id) {
                $queryBuilder->where('id', '!=', $id);
            }

            $exists = $queryBuilder->exists();
        } elseif ($request->user_type === 'doctor') {
            $queryBuilder = Doctor::where('email', $email);
            if ($id) {
                $queryBuilder->where('id', '!=', $id);
            }

            $exists = $queryBuilder->exists();
        } elseif ($request->user_type === 'user') {
            $queryBuilder = User::where('email', $email);
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
        if ($request->user_type === 'hospital') {
            $queryBuilder = Hospital::where('mobile_no', $mobile_no);
            if ($id) {
                $queryBuilder->where('id', '!=', $id);
            }
            $exists = $queryBuilder->exists();
        } elseif ($request->user_type === 'doctor') {
            $queryBuilder = Doctor::where('mobile_no', $mobile_no);
            if ($id) {
                $queryBuilder->where('id', '!=', $id);
            }

            $exists = $queryBuilder->exists();
        } elseif ($request->user_type === 'user') {
            $queryBuilder = User::where('mobile_no', $mobile_no);
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
        # Request params
        $password = $request->input('current_password');
        if (Auth::guard('hospital')->check()) {

            if (Hash::check($password, Auth::guard('hospital')->user()->password)) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } elseif (Auth::guard('doctor')->check()) {

            if (Hash::check($password, Auth::guard('doctor')->user()->password)) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } elseif (Auth::guard('web')->check()) {

            if (Hash::check($password, Auth::guard('web')->user()->password)) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
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

            activity('Update profile')
                ->performedOn($hospital)
                ->log($request->hospital_name . ' details are updated');

            session()->flash('message', 'Hospital details update successfully..!');
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
            if (Auth::guard('hospital')->check()) {
                if ($user_type === 'hospital') {
                    $doctor = Hospital::findOrFail(Auth::guard('hospital')->user()->id);
                    $doctor->password = Hash::make($request->password);
                    $doctor->save();
                } elseif ($user_type === 'doctor') {
                    $hospital = Doctor::findOrFail($id);
                    $hospital->password = Hash::make($request->password);;
                    $hospital->save();
                } elseif ($user_type === 'user') {
                    $hospital = User::findOrFail($id);
                    $hospital->password = Hash::make($request->password);;
                    $hospital->save();
                }
            } elseif (Auth::guard('doctor')->check()) {
                $doctor = Doctor::findOrFail(Auth::guard('doctor')->user()->id);
                $doctor->password = Hash::make($request->password);;
                $doctor->save();
            } elseif (Auth::guard('web')->check()) {
                $user = User::findOrFail(Auth::guard('web')->user()->id);
                $user->password = Hash::make($request->password);;
                $user->save();
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
        if ($user_type === 'hospital') {
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
        } elseif ($user_type === 'doctor') {
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
        } elseif ($user_type === 'user') {
            $data = User::where('email', $new_email);
            $exists = $data->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'This email already registered with us.',
                    'status' => 401,
                ])->setStatusCode(401);
            } else {
                $obj = User::find($id);
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
        if ($user_type === 'hospital') {
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
        } elseif ($user_type === 'doctor') {
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
        } elseif ($user_type === 'user') {
            $data = User::where('mobile_no', $new_mobile_no);
            $exists = $data->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'This email already registered with us.',
                    'status' => 401,
                ])->setStatusCode(401);
            } else {
                $obj = User::find($id);
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

                activity('Update email')
                    ->performedOn($hospital)
                    ->log($hospital->name . ' email are update');

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
        } elseif ($user_type === 'doctor') {
            $doctor = Doctor::find($id);
            $dbcode = $doctor->verification_code;
            if ($dbcode === $code) {
                $doctor->email = $newemail;
                $doctor->verification_code = null;
                $doctor->token = null;
                $doctor->save();

                activity('Update email')
                    ->performedOn($doctor)
                    ->log('Dr. ' . $doctor->name . ' email are update');


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
        } elseif ($user_type === 'user') {
            $user = User::find($id);
            $dbcode = $user->verification_code;
            if ($dbcode === $code) {
                $user->email = $newemail;
                $user->verification_code = null;
                $user->token = null;
                $user->save();

                activity('Update email')
                    ->performedOn($user)
                    ->log($user->name . ' email are update');


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

                activity('Update mobile no')
                    ->performedOn($hospital)
                    ->log($hospital->name . ' mobile number are update');


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
        } elseif ($user_type === 'doctor') {
            $doctor = Doctor::find($id);
            $dbcode = $doctor->verification_code;
            if ($dbcode === $code) {
                $doctor->mobile_no = $newMobile;
                $doctor->verification_code = null;
                $doctor->token = null;
                $doctor->save();

                activity('Update mobile no')
                    ->performedOn($doctor)
                    ->log('Dr. ' . $doctor->name . ' mobile number are update');


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
        } elseif ($user_type === 'user') {
            $user = User::find($id);
            $dbcode = $user->verification_code;
            if ($dbcode === $code) {
                $user->mobile_no = $newMobile;
                $user->verification_code = null;
                $user->token = null;
                $user->save();

                activity('Update mobile no')
                    ->performedOn($user)
                    ->log($user->name . ' mobile number are update');


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
    }

    public function changeStatus(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        if ($request->user_type === 'doctor') {
            $doctor = Doctor::findOrFail($id);
            $doctor->status = ($doctor->status === "active") ? "inactive" : "active";
            $doctor->save();

            activity('Update doctor status')
                ->performedOn($doctor)
                ->log('Dr. ' . $doctor->name . ' status is ' . (($doctor->status === "active") ? "active" : "inactive"));

            session()->flash('message', $doctor->name . ' Status Updated..!');
        } elseif ($request->user_type === 'user') {
            $user = User::findOrFail($id);
            $user->status = ($user->status === "active") ? "inactive" : "active";
            $user->save();

            activity('Update user status')
                ->performedOn($user)
                ->log($user->name . ' status is ' . (($user->status === "active") ? "active" : "inactive"));

            session()->flash('message', $user->name . ' Status Updated..!');
        }

        return redirect()->back();
    }

    public function restore(Request $request, $id)
    {
        if ($request->user_type === 'doctor') {
            $doctor = Doctor::withTrashed()->findOrFail($id);
            $doctor->restore();

            activity('Restore doctor')
                ->performedOn($doctor)
                ->log('Dr. ' . $doctor->name . ' are restore');

            session()->flash('message', 'Dr. ' . $doctor->name . ' Restore Successfully..!');
            return redirect()->route('doctor.index');
        } elseif ($request->user_type === 'user') {
            $user = User::withTrashed()->findOrFail($id);
            $user->restore();

            activity('Restore user')
                ->performedOn($user)
                ->log($user->name . ' are restore');

            session()->flash('message', $user->name . ' Restore Successfully..!');
            return redirect()->route('user.index');
        }
    }

    public function fetchCities(Request $request): string
    {
        $cities = City::where("state_id", $request->stateId)->get();
        return view('components.city', [
            'cities' => $cities,
            'selected' => $request->selected
        ])->render();
    }

}
