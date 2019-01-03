<?php

namespace App\Http\Controllers\Auth;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AuthActivate\ActivationService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $activationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        DB::connection('mysql');
        $this->middleware('guest', ['except' => 'logout']);
        $this->activationService = $activationService;
    }

    /*
     * Modified login method
     *
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'login'    => 'required',
            'password' => 'required',
        ]);

        $remember   = $request->has('remember') ? true : false;
        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL ) 
            ? 'email' 
            : 'username';

        $request->merge([
            $login_type => $request->input('login')
        ]);

        if ( Auth::attempt( array_merge($request->only($login_type, 'password')), $remember == 'on' ? true : false )) {

            // return $request;
            return $this->authenticated($request, $this->guard()->user());
        } else {
            return $this->sendFailedLoginResponse($request);
        }

        
        
        // return redirect('/login')->with('warning', 'These credentials do not match our records.');
    }
    /*
     * activate user on email request
     *
     */
    public function activateUser($token)
    {
        if ($user = $this->activationService->activateUser($token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }

        abort(404);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ( !$user->isActive ) {

            auth()->logout();

            return redirect('/login')->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }

        // return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/login');
    }
}
