<?php

namespace App\Http\Controllers\User;

use App\DataTables\DeletedUserDataTable;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Hospital;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;


class UserController extends Controller
{
    //
    public function index(UserDataTable $dataTable  )
    {
        $hospital = Hospital::findOrFail(1);
        return $dataTable->render('user.index', ['hospital' => $hospital]);
//        return view('user.index', ['hospital' => $hospital]);
    }

    public function addUser()
    {

        $hospital = Hospital::findOrFail(1);
        $state = State::all();
        $city = City::all();
        return view('user.add_user', ['hospital' => $hospital, 'states' => $state, 'cities' => $city]);
    }

    public function submitUser(Request $request)
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
            'profile_photo' => 'required',
            'document' => 'required',
        );
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $user = new User();
            $profile_photo = $request->profile_photo;
            $document = $request->document;
            $user->name = $request->name;
            $user->mobile_no = $request->mobile_no;
            $user->email  = $request->email;
            $user->address  = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->pin_code	 = $request->pin_code;
            $user->aadhar_no	 = $request->aadhar_no;
            $user->gender	 = $request->gender;
            $user->dob = $request->dob;
            $user->password = Hash::make('1234');

            if ($profile_photo) {
                $destinationPath = public_path() . '/upload_file/user/';
                $fileName = $request->name . '_' . $request->profile_photo->getClientOriginalName();
                $user->profile_photo = $fileName;
                $profile_photo->move($destinationPath, $fileName);
            }
            if ($document) {
                $destinationPath = public_path() . '/upload_file/user/user_document/';
                $fileName = $request->aadhar_no . '_' . $request->document->getClientOriginalName();
                $user->document_photo = $fileName;
                $document->move($destinationPath, $fileName);
            }
            $user->save();
            session()->flash('message', 'User Add Successfully..!');
            return redirect()->route('user.index');
        }

    }

    public function userDetails(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $hospital = Hospital::findOrFail(1);
        $state = State::all();
        $city = City::all();
        return view('user.user_details', ['user' => $user, 'hospital' => $hospital, 'states' => $state, 'cities' => $city]);
    }

    public function userDetailsUpdate(Request $request)
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
            $user = User::findOrFail($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            $user->address = $request->address;
            $user->state = $request->state;
            $user->city = $request->city;
            $user->pin_code = $request->pin_code;
            $user->aadhar_no = $request->aadhar_no;
            $user->dob = $request->dob;
            $profile_photo = $request->profile_photo;
            $document_photo = $request->document_photo;
            if ($profile_photo) {
                $destinationPath = public_path() . '/upload_file/user/';
                $fileName = $request->name . '_' . $request->profile_photo->getClientOriginalName();
                $image_path = public_path("upload_file/user/{$user->profile_photo}");
                if (File::exists($image_path)) {
                    unlink($image_path);
                }
                $profile_photo->move($destinationPath, $fileName);
                $user->profile_photo = $fileName;
            }
            if ($document_photo) {
                $destinationPath = public_path() . '/upload_file/user/user_document';
                $fileName = $request->aadhar_no . '_' . $request->document_photo->getClientOriginalName();
                $image_path = public_path("upload_file/user/user_document/{$user->document_photo}");
                if (File::exists($image_path)) {
                    unlink($image_path);
                }
                $document_photo->move($destinationPath, $fileName);
                $user->document_photo = $fileName;
            }
            $user->save();
            session()->flash('message', 'User Details Update Successfully..!');
            return redirect()->back();
        }
    }

    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        session()->flash('message', 'Dr. '.$user->name.' are Delete Successfully..!');
        return redirect()->route('user.index');
    }

    public function deletedUser(DeletedUserDataTable $dataTable)
    {
        $hospital = Hospital::findOrFail(1);
        return $dataTable->render('user.deleted_user', ['hospital' => $hospital]);
    }

}
