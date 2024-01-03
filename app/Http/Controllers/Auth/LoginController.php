<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //login the user
    public function login(Request $request)
    {
         $request->validate([
            // VALIDATIONS
            'email'           =>  'required',
            'password'        =>  'required',
        ]);

        $user= User::where('email', $request->input('email'))->first();

        if (auth()->guard('web')->attempt(['email' => $request->input('email'),'password' => $request->input('password')])) {
             $new_session_id=\Session::getId();

             if ($user->session !='') {
               
                    User::where('id',$user->id)->update(['session' => $new_session_id]);
                    $user=auth()->guard('web')->user();
                    return redirect()->to('/home');
                }
                else{
                    return redirect()->to('/home');
                }
 
             }
        
        return back()->with('error','Mauvais utilisateur ou mot de passe');

    }

    //logout the user 
    public function logout(Request $request)
    {
        $user=Auth::user()->id;
        User::where('id',$user)->update(['session' => '']);

        \Session::flush();
        \Session::put('success,Logout successful');

        return redirect()->to('/login');
    }
}
