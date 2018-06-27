<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Set the guard
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * Set the Broker
     *
     * @var string
     */
    protected $broker = 'admins';

    /**
     * @var string
     */
    protected $resetView = 'admin.auth.passwords.reset';

    /**
     * @var string
     */
    protected $linkRequestView = 'admin.auth.passwords.email';

    /**
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
