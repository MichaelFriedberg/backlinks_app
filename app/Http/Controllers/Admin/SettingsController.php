<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show form to edit settings
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.settings.edit', compact('admin'));
    }

    /**
     * Update settings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $rules = [
            'email' => 'required|email'
        ];

        if (!empty($request->input('password'))) {
            $rules['password'] = 'confirmed';
        }

        $this->validate($request, $rules);

        $admin = Auth::guard('admin')->user();

        $admin->email = trim($request->input('email'));

        if (!empty($request->input('password'))) {
            $admin->password = bcrypt(trim($request->input('password')));
        }

        $admin->save();

        Alert::success('Settings updated.')->flash();

        return redirect()->route('admin.settings.edit');
    }
}
