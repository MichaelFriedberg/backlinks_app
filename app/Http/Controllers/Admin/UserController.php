<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$user->id}"
        ];

        if (! empty($request->input('password'))) {
            $rules['password'] = 'min:6|confirmed';
        }

        $this->validate($request, $rules);

        $user->name = trim($request->input('name'));
        $user->email = trim($request->input('email'));

        if (!empty($request->input('password'))) {
            $user->password = bcrypt(trim($request->input('password')));
        }

        $user->save();

        Alert::success('User updated.')->flash();

        return redirect()->route('admin.user.edit', $user);
    }

    /**
     * Confirm before deleting resource
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmDelete(User $user)
    {
        return view('admin.user.confirm-delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        Alert::success('User deleted.')->flash();

        return redirect()->route('admin.user.index');
    }
}
