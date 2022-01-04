<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    public function store($request)
    {
        return $this->createOrUpdate($request, new User());
    }

    private function createOrUpdate($request, User $user): User
    {
        $newUser = empty($user->id);

        // Request params
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile_no = $request->input('mobile_no');
        $address = $request->input('address');
        $state = $request->input('state');
        $city = $request->input('city');
        $pin_code = $request->input('pin_code');
        $aadhar_no = $request->input('aadhar_no');
        $gender = $request->input('gender');
        $dob = $request->input('dob');
        $profile_photo = $request->profile_photo;
        $document_photo = $request->document_photo;
        $password = Hash::make('password');

        // save data
        $user->name = $name;
        $user->mobile_no = $mobile_no;
        $user->email = $email;
        $user->address = $address;
        $user->city_id = $city;
        $user->state_id = $state;
        $user->pin_code = $pin_code;
        $user->aadhar_no = $aadhar_no;
        $user->dob = $dob;
        $user->password = $password;

        if ($newUser) {

            $user->gender = $gender;

            if ($profile_photo) {
                $destinationPath = public_path() . '/upload_file/user/';
                $fileName = $name . '_' . $profile_photo->getClientOriginalName();
                $user->profile_photo = $fileName;
                $profile_photo->move($destinationPath, $fileName);
            }

            if ($document_photo) {
                $destinationPath = public_path() . '/upload_file/user/user_document/';
                $fileName = $aadhar_no . '_' . $document_photo->getClientOriginalName();
                $user->document_photo = $fileName;
                $document_photo->move($destinationPath, $fileName);
            }
        }

        if (!$newUser) {

            if ($profile_photo) {
                $destinationPath = public_path() . '/upload_file/user/';
                $fileName = $name . '_' . $profile_photo->getClientOriginalName();
                $image_path = public_path("upload_file/user/{$user->profile_photo}");
                if (File::exists($image_path)) {
                    unlink($image_path);
                }
                $profile_photo->move($destinationPath, $fileName);
                $user->profile_photo = $fileName;
            }
            if ($document_photo) {
                $destinationPath = public_path() . '/upload_file/user/user_document';
                $fileName = $aadhar_no . '_' . $document_photo->getClientOriginalName();
                $image_path = public_path("upload_file/user/user_document/{$user->document_photo}");
                if (File::exists($image_path)) {
                    unlink($image_path);
                }
                $document_photo->move($destinationPath, $fileName);
                $user->document_photo = $fileName;
            }
        }

        $user->save();

        if ($newUser) {
            activity('Add user')
                ->performedOn($user)
                ->log($name . ' are added');
        } else {
            activity('Update user')
                ->performedOn($user)
                ->log($name . ' are updated');
        }

        return $user;
    }

    public function update($request, User $user)
    {
        return $this->createOrUpdate($request, $user);
    }
}
