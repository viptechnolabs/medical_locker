<?php

namespace App\Http\Controllers\User;

use App\DataTables\DeletedUserDataTable;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Hospital;
use App\Models\State;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;


class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(UserDataTable $dataTable)
    {
        $hospital = Hospital::findOrFail(1);
        $users = User::all();
//        return $dataTable->render('user.index', ['hospital' => $hospital]);
        return view('user.index', ['hospital' => $hospital, 'users' => $users]);
    }

    public function addUser()
    {
        $hospital = Hospital::findOrFail(1);
        $state = State::all();
        $city = City::all();
        return view('user.add_user', ['hospital' => $hospital, 'states' => $state, 'cities' => $city]);
    }

    public function storeUser(UserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->userRepository->store($request);
        session()->flash('message', 'User Add Successfully..!');
        return redirect()->route('user.index');
    }

    public function userDetails(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $hospital = Hospital::findOrFail(1);
        $state = State::all();
        $city = City::all();
        return view('user.user_details', ['user' => $user, 'hospital' => $hospital, 'states' => $state, 'cities' => $city]);
    }

    public function userDetailsUpdate(UserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $id = $request->input('id');
        $user = User::findOrFail($id);

        $this->userRepository->update($request, $user);
        session()->flash('message', 'User Details Update Successfully..!');
        return redirect()->back();
    }

    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        activity('Delete user')
            ->performedOn($user)
            ->log($user->name . ' are deleted');

        session()->flash('message', $user->name . ' are Delete Successfully..!');
        return redirect()->route('user.index');
    }

    public function deletedUser(DeletedUserDataTable $dataTable)
    {
        $hospital = Hospital::findOrFail(1);
        $users = User::onlyTrashed()->get();
        return $dataTable->render('user.deleted_user', ['hospital' => $hospital, 'users' => $users]);
    }

}
