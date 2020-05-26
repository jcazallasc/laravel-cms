<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\Users\UpdateUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('users.index')->with('users', User::where('id', '!=', auth()->id())->get());
    }

    public function edit()
    {
        return view('users.edit')->with('user', auth()->user());
    }

    public function update(UpdateUserRequest $request)
    {
        $user = auth()->user();
        $user->update($request->only(['name', 'about']));

        Session::flash('success', 'Profile updated successfully!');
        return redirect(route('users.edit-profile'));
    }    

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();

        Session::flash('success', 'User made admin successfully!');
        return Redirect::to(route('users.index'));
    }
}
