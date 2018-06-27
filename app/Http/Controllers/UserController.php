<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prologue\Alerts\Facades\Alert;

class UserController extends Controller
{
    /**
     * Edit user settings
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();

        return view('user.edit', compact('user'));
    }

    /**
     * Update user settings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$user->id}",
            'paypal_email' => 'email'
        ];

        if (!empty($request->input('password'))) {
            $rules['password'] = 'min:6|confirmed';
        }

        $this->validate($request, $rules);

        $user->name = trim($request->input('name'));
        $user->email = trim($request->input('email'));
        $user->paypal_email = trim($request->input('paypal_email'));

        if (!empty($request->input('password'))) {
            $user->password = bcrypt(trim($request->input('password')));
        }

        $user->save();

        Alert::success('User settings updated.')->flash();

        return redirect()->route('user.edit');
    }
}
